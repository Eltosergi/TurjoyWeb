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

        $code = generateCode();
        // Modificar request
        $request->request->add(['code' => $code]);

        // Validar

        // Obtener viaje
        $tripId = Trip::where('origin', $request->origin)->where('destination', $request->destination)->pluck('id')->first();

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

    }



}
