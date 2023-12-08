<?php


use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Support\Str;
use App\Http\Controllers\VoucherController;


function makeMessages()
{
    $messages = [
        'email.required' => 'debe ingresar su correo electrónico para iniciar sesión',
        'password.required' => 'debe ingresar su contraseña para iniciar sesión',
        'document.required' => 'el campo archivo es requerido.',
        'document.mimes' => 'el archivo seleccionado no es Excel con extensión .xlsx.',

        'document.max' => 'el tamaño máximo del archivo a cargar no puede superar los 5 megabytes',



        'date.required' => 'el campo fecha es requerido.',
        'origins.required' => 'el campo origen es requerido.',
        'destinations.required' => 'el campo destino es requerido.',
        'seats.required' => 'el campo asientos es requerido.',
        'code.required'=> 'debe proporcionar un código de reserva',
        'seat.numeric' => 'el campo asientos debe ser numérico',
        'seat.min' => 'el campo asientos debe ser mayor a 0',
        'seat.max' => 'el campo asientos debe ser menor a la cantidad de asientos disponibles',
        'date.date' => 'el campo fecha debe ser una fecha válida',
        'origin.string' => 'el campo origen debe ser válido',

        'destination.string' => 'el campo destino debe ser válido',
        'origin.exists' => 'el campo origen debe ser válido',
        'destination.exists' => 'el campo destino debe ser válido',

        'start.required' => 'el campo fecha de inicio es requerido',
        'start.date' => 'el campo fecha de inicio debe ser una fecha válida',
        'end.required' => 'el campo fecha de término es requerido',
        'end.date' => 'el campo fecha de término debe ser una fecha válida',
        'end' => 'la fecha de inicio a consultar no puede ser mayor que la fecha de término de la consulta',


    ];

    return $messages;
}

function verifyDate($date)
{
    $currentDate = date('Y-m-d');
    $verifyDate = Carbon::parse($date);
    if($verifyDate->lessThan($currentDate)){
        return true;
    }
    return false;
}

function generateCode(){
    do{
        $alfa = Str::random(4);
        $numeric = mt_rand(10, 99);


        while (true) {

            if (preg_match('/^[a-zA-Z]{4}$/', $alfa)) {
                break;
            } else {
                $alfa = Str::random(4);
            }
        }
        $alfa = strtoupper($alfa);
        $code = $alfa.$numeric;
        $request = Ticket::where('code', $code)->first();



    }while($request);
    return $code;
}

