<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class QRController extends Controller
{
    public function generateQrCode()
    {
        // Obtener la URL de la ruta 'presentacion'
        $url = URL::route('redireccion');

        // Crear el código QR con la URL generada
        $qrCode = new QrCode($url);

        // Generar la imagen en formato PNG
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Devolver la imagen como respuesta HTTP
        return Response::make($result->getString(), 200, ['Content-Type' => 'image/png']);
    }
    public function index()
    {
        $user=User::find(1);
        $datos = [
            'redes'=> $user->socialMedia,
        ];
        return view('presentation',['datos'=>$datos]);
    }
}
