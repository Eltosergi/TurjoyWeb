<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\Trip;
use App\Models\Voucher;
use App\Http\Controllers\VoucherController;


class TicketController extends Controller
{
    public function store(Request $request){
        $messages = makeMessages();
        $tripSeats = Trip::where('origin', $request->origin)->where('destination', $request->destination)->pluck('qtySeats')->first();
        $this->validate($request, [
            'seat' => ['required', 'numeric', 'min:1','max:'.$tripSeats],
            'date' => ['required', 'date'],
            'origin' => ['required', 'string','exists:trips,origin'],
            'destination' => ['required', 'string','exists:trips,destination'],
        ], $messages);



        try{

            $code = generateCode();
            // Modificar request
            $request->request->add(['code' => $code]);



            if($request->origin == $request->destination){
                return redirect()->route('error');
            }



            if($request->origin == $request->destination){
                return redirect()->route('error');
            }

            // Obtener viaje
            $trip = Trip::where('origin', $request->origin)->where('destination', $request->destination)->first();

            if ( $trip -> qtySeats < $request->seat) {
                return redirect()->route('reserve')->with('error', 'Cantidad inválida. Ingrese un valor aceptado');
            }

            $tripId = $trip->id;

            // Crear la reserva
            $ticket = Ticket::create([
            'code' => $request->code,
            'seat' => $request->seat,
            'total' => $request->total,
            'date' => $request->date,
            'tripId' => $tripId,
            ]);



            return redirect()->route('generate.pdf', [
                'id' => $ticket->id,
            ]);

        }catch(\Exception $e){

            return redirect()->route('error');


        }

    }
}
