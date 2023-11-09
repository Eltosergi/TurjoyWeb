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
        $trip_id = Trip::where('origin', $request->origins)->where('destination', $request->destinations)->pluck('id')->first();

        // Crear la reserva
        $ticket = Ticket::create([
        'code' => $request->code,
        'seat' => $request->seats,
        'total' => $request->total,
        'date' => $request->date,
        'trips_id' => $trip_id,
        ]);

        return redirect()->route('generate.pdf', [
            'id' => $ticket->id,
        ]);

    }



}
