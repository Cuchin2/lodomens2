<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReclamationMail;
use App\Mail\ConfirmationMail;
class ReclamationController extends Controller
{
    public function index(){
        return view('web.reclamation');
    }
    public function send(Request $request){
        $toEmail = 'contacto@lodomens.com';
        $request->validate([
            'fromName' => 'required',
            'correo' => 'required|email',
            'subject' => 'required',
            'body' => 'required',
        ], [
            'fromName.required' => 'El nombre del remitente es obligatorio.',
            'correo.required' => 'La dirección de correo electrónico es obligatoria.',
            'correo.email' => 'Por favor ingresa una dirección de correo electrónico válida.',
            'subject.required' => 'El asunto del correo es obligatorio.',
            'body.required' => 'El cuerpo del correo es obligatorio.',
        ]);

        $subject= $request->subject;
        $mailData= [
            'email' =>'contacto@lodomens.com',
            'subject' => 'Lodomens: '.$subject,
            'correo' => $request->correo,
            'fromName' => $request->fromName,
            'title' => $subject,
            'body'  => $request->body
        ];
        Mail::to($toEmail)->send(new ReclamationMail($mailData));
    // 📌 2️⃣ Correo de confirmación al usuario
    $confirmationData = [
        'email' =>'contacto@lodomens.com',
        'from' => 'Lodomens Soporte',
        'name'=>$request->fromName,
        'subject' => 'Lodomens: '.$subject,
    ];

        Mail::to($request->correo)->send(new ConfirmationMail($confirmationData));
        return response()->json(['message' => 'Correo enviado exitosamente']);
    }
}
