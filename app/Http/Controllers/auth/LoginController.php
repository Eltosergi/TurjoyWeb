<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    //
    public function store(Request $request)
    {
        //Error messages
        $messages = makeMessages();

        //User validation
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


        //Redirect to welcome page
        return redirect()->route('welcome');
    }
}
