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
        // PROBLEMAS CON: create -> filds de ticket son solo code, seat, total, date, trips_id. Total no viene de la view reserve
        $code = generateCode();
        // Modificar request
        $request->request->add(['code' => $code]);

        // Validar

        // Obtener viaje
        $trip_id = Trip::where('origin', $request->origin)->where('destination', $request->destination)->pluck('id')->first();

        // Crear la reserva
        $ticket = Ticket::create([
        'code' => $request->code,
        'seat' => $request->seat,
        'total' => $request->total,
        'date' => $request->date,
        'trips_id' => $trip_id,
        ]);


        return redirect()->route('generate.pdf', [
            'id' => $ticket->id,
        ]);

    }
}




