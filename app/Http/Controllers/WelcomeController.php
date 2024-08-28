<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function verificar(){
        if(session('status') == 'Validation email'){
        return view('layouts.verified');
        }
        return redirect()->route('root');
    }
    public function bienvenido(){
        if(session('status') == 'Email verified'){
            return view('layouts.register_successfully')->with('status', session('status'));
        }
        return redirect()->route('root');
    }

}
