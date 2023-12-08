<?php

namespace App\Http\Controllers\auth;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\Trip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $sql = "SELECT d.id, d.created_at, d.date, t.origin, t.destination, d.seat, d.total
                FROM tickets d INNER JOIN trips t ON d.tripId = t.id";

        // Almacenar la consulta SQL en una variable
        $result = DB::select($sql);
        return view('admin.auth.report', [
            'ticketRows' => $result,
            'countTicket' => count($result)
        ]);
    }


    public function searchToDate(Request $request)
    {
        $messages = makeMessages();
        // Validar
        $this->validate($request, [
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after:start'],
        ], $messages);

        // Validar que la fecha inicial sea menor a la final

        $start = $request->start;
        $end = $request->end;

        $startF = date('Y-m-d', strtotime(str_replace('-', '/', $start)));
        $endF = date('Y-m-d', strtotime(str_replace('-', '/', $end)));
        // Filtrado
        $tickets = Ticket::whereBetween('date', [$startF, $endF])->with('trip')->paginate(5);

        if ($tickets->count() === 0) {
            return back()->with('message', 'no se encontraron reservas dentro del rango seleccionado');
        }

        return view('admin.auth.report', [
            'tickets' => $tickets,
        ]);
    }

    public function ticketReportIndex()
    {
        $tickets = Ticket::paginate(5);

        return view('admin.auth.report', [
            'tickets' => $tickets,
        ]);
    }

    public function ticketReportSearchIndex($tickets)
    {
        $ticketSearch = Ticket::find($tickets);

        // dd($ticketSearch);

        return view('admin.auth.report', [
            'tickets' => $ticketSearch,
        ]);
    }
}
