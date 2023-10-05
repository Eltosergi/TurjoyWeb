<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    //



    public function store(Request $request)
    {



        $messages = makeMessages();

        $this->validate($request, [
            'email'=> ['required'],
            'password' => ['required']
        ], $messages);



        if(!auth()->attempt([
            'email'=> $request->email,
            'password' => $request->password
        ])){
            return back()->with('message', 'usuario no registrado o contraseña incorrecta');
        }


        //Ingresar ruta del cargar viajes
        return redirect()->route('welcome');
    }
}
