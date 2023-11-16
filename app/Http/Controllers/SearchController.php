<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Ticket;
use App\Models\Voucher;
use App\Models\Trip;

class SearchController extends Controller
{
    public function create()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $message = makeMessages();
        $this->validate($request, ['code' => ['required']], $message);
        try {

            $code = $request->code;
            $ticket = Ticket::where('code', $code);

            if (!$ticket->first()) {
                return redirect()->back()->with('error', 'La reserva ' . $code . ' no existe en el sistema');
            }

            $trip = Trip::where('id', $ticket->first()->tripId);

            if (!$trip->first()) {
                return redirect()->back()->with('error', 'Error del sistema, contactese con el administrador');
            }

            $voucher = Voucher::where('ticketId', $ticket->first()->id)->first();

            if (!$voucher) {
                return redirect()->back()->with('error', 'Error del sistema, contactese con el administrador');
            }

            return view('client.result', [
                'ticket' => $ticket->first(),
                'voucher' => $voucher,
                'trip' => $trip->first(),
            ]);

        } catch (QueryException $e) {
            // Manejar la excepción de la base de datos aquí
            return redirect()->route('error');
        } catch (\Exception $e) {
            // Manejar otras excepciones aquí

            return redirect()->route('error');
        }
    }


}
