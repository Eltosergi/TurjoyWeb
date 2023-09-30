<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;

class LoginController extends Controller
{
    //


    public function store(Request $request)
    {
        $messages = makeMessages();

        $this->validate($request, [
            'email'=> ['required', 'email'],
            'password' => ['required']
        ], $messages);



        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('message', 'usuario no registrado o contraseña incorrecta');
        }


        //Ingresar ruta del cargar viajes
        return redirect()->route('test');
    }
}
