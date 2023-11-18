<?php

namespace App\Http\Controllers\auth;
use Illuminate\Support\Facades\DB;

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
}
