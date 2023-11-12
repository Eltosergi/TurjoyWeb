<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $this-> validate($request, ['code' => ['required']], $message);

        $code = $request -> code;
        $ticket = Ticket::where('code', $code);
        if (!$ticket->first()) {
            return redirect()->back()->with('error', 'la reserva '.$code.' no existe en
            sistema');
        }
        $trip = Trip::where('id',$ticket-> first() ->tripId);
        if (!$trip->first()) {
            return redirect()->back()->with('error', 'Error del sistema, Contactese con el administrador');
        }

        $voucher = Voucher::where('ticketId',$ticket->first()->id)->first();
        if (!$voucher->first()) {
            return redirect()->back()->with('error', 'Error del sistema, Contactese con el administrador');
        }
        return view('client.result', [
           'ticket' => $ticket-> first(),
           'voucher' => $voucher-> first(),
           'trip' => $trip-> first(),
        ]);
    }

}
