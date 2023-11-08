<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Ticket;
use App\Imports\TripImport;
use app\Helpers\MyHelper;
use Illuminate\Support\Facades\Session;

class TripController extends Controller
{
    public function indexAddTravels()
    {

        if (session('validRows') || session('invalidRows') || session('duplicatedRows')) {
            session()->put('validRows', []);
            session()->put('invalidRows', []);
            session()->put('duplicatedRows', []);
        } else {
            session(['validRows' => []]);
            session(['invalidRows' => []]);
            session(['duplicatedRows' => []]);
        }

        return view('Index.index', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);
    }

    public function indexTravels()
    {
        return view('Index.index', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);
    }
    public function travelCheck(Request $request)
    {

        //Validar el archivo general
        $messages = makeMessages();
        $this->validate($request, [
            'document' => ['max:5120 ', 'required', 'mimes:xlsx'],
        ], $messages);

        //Validar el archivo excel en detalle
        if ($request->hasFile('document')) {
            $file = request()->file('document');
            
            $import = new TripImport();
            Excel::import($import, $file);
            if(!$import->getValidRows() && !$import->getInvalidRows() && !$import->getDuplicatedRows()){
                // Agregar mensaje de error a la sesión
                Session::flash('error', 'Hubo un problema con la importación. Por favor, verifica el archivo.');
                return redirect()->route('index');
            }
            // Obtener filas válidas e inválidas
            $validRows = $import->getValidRows();
            $invalidRows = $import->getInvalidRows();
            $duplicatedRows = $import->getDuplicatedRows();

            // dd($validRows, $invalidRows, $duplicatedRows);
            if(count($validRows) == 0 )
            {
                Session::flash('error', 'El archivo esta vacio');
                return redirect()->route('index');
            }
            // Agregar o actualizar las filas en la base de datos
            foreach ($validRows as $row) {
                $origin = $row['origen'];
                $destination = $row['destino'];

                // Verifica si la fila ya existe en la base de datos
                $travel = Trip::where('origin', $origin)
                    ->where('destination', $destination)
                    ->first();

                if ($travel) {
                    // Si existe, realiza una actualización
                    $travel->update([
                        'qtySeats' => $row['cantidad_de_asientos'],
                        'price' => $row['tarifa_base'],
                    ]);
                } else {
                    // Si no existe, inserta un nuevo viaje a la base de datos
                    Trip::create([
                        'origin' => $origin,
                        'destination' => $destination,
                        'qtySeats' => $row['cantidad_de_asientos'],
                        'price' => $row['tarifa_base'],
                    ]);
                }
            }

            //Eliminar registros (filas) vacios del  documento excel
            $invalidRows = array_filter($invalidRows, function ($invalidrow) {
                return $invalidrow['origen'] !== null || $invalidrow['destino'] !== null || $invalidrow['cantidad_de_asientos'] !== null || $invalidrow['tarifa_base'] !== null;
            });

            // dd(session('invalidRows'));

            session()->put('validRows', $validRows);
            session()->put('invalidRows', $invalidRows);
            session()->put('duplicatedRows', $duplicatedRows);

            // dd(count(session('validRows')), count(session('invalidRows')));

            return redirect()->route('travelsAdd.index');
        }
    }

    public function getOrigins()
    {
        $origins = Trip::distinct()->orderBy('origin','asc')->pluck('origin');

        return response()->json([
            'origins' => $origins,
        ]);
    }

    public function getDestinations()
    {
        $destinations = Trip::distinct()->orderBy('destination','asc')->pluck('destination');

        return response()->json([
            'destinations' => $destinations,
        ]);
    }
    public function searchDestinations($origin)
    {
        $destinations = Trip::where('origin', $origin)->orderBy('destination','asc')->pluck('destination');

        return response()->json([
            'destination' => $destinations,
        ]);
    }
    public function seatings($origin, $destination)
    {
        //$ticketId = Ticket::ticketId($origin, $destination, $selectedDate);
        //$usedSeats = Voucher::usedSeats($ticketId);

        $seats = Trip::where('origin', $origin)
        ->where('destination', $destination)
        ->pluck('qtySeats');
        return response()->json([
            'seats' => $seats
        ]);



    }
    public function reserveIndex()
    {
        $travels = Trip::get()->count();


        return view('reserve',[
            'countTravels' => $travels,
        ]);
    }
}
