<?php

namespace App\Http\Controllers;


use App\Models\Ticket;
use App\Models\Voucher;
use App\Models\Trip;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class VoucherController extends Controller
{
    public function downloadPDF($id)
    {
            // Obtener la información del PDF desde la base de datos
            $pdf = Voucher::findOrFail($id);

            // Obtener la ruta del archivo PDF
            $path = storage_path('app\public\\'.$pdf->uri);

            // Obtener el nombre original del archivo
            $filename = $pdf->pdf_name;

            // Obtener el tipo MIME del archivo PDF
            $mimeType = Storage::mimeType($path);

            // Devolver el archivo PDF como una descarga
            return response()->download($path, $filename, ['Content-Type' => $mimeType]);


    }

    public function generatePDF($idTicket)
    {

            $ticket = Ticket::findOrFail($idTicket);

            // Crear una instacia de Dompdf
            $domPDF = new Dompdf();
            $trip = Trip::findOrFail($ticket->tripId);


            $view_html = view('client.voucher', [
                'ticket' => $ticket,
                'date' => date('d-m-Y'),
                'trip' => $trip,
            ])->render();

            $domPDF->loadHtml($view_html);

            $domPDF->setPaper('A4', 'portrait');

            $domPDF->render();

            // Generar nombre de archivo aleatorio
            $fileName = 'user_'.Str::random(10).'.pdf';

            // Guardar el PDF en la carpeta public
            $path = 'pdfs\\'.$fileName;
            Storage::disk('public')->put($path, $domPDF->output());

            $voucher = Voucher::create([
                'uri' => $path,
                'date' => date('Y-m-d'),
                'ticketId' => $idTicket
            ]);




            return view('client.reserveSuccess', [
                'ticket' => $ticket,
                'voucher' => $voucher,
                'trip' => $trip,
            ]);


    }




}
