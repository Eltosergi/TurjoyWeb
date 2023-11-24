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
        try{ 

            $code = generateCode();
            // Modificar request
            $request->request->add(['code' => $code]);

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
