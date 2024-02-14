<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Footer;
use Illuminate\Support\Facades\Storage;
class FooterController extends Controller
{
    public function edit()
    {

        $user = User::find(1);
        $footer = Footer::find(1);
        $url = asset('storage/'.$footer->logo);
        return view('admin.mypage.footer', compact('user', 'footer','url'));
    }
    public function update(Request $request, $id)
    {
        $footer = Footer::find($id);
        //Actualizando la foto
        if ($request->hasFile('photo')) {
            // Lógica para guardar la nueva foto
            $nuevaFoto = $request->file('photo');
            $nombreFoto = uniqid() . '.' . $nuevaFoto->getClientOriginalExtension();
            $fotoAnterior = $footer->logo;
            if ($fotoAnterior) {
                // Eliminar la foto anterior del almacenamiento
                $filePath = storage_path('app/public/'.$fotoAnterior);
                unlink($filePath);
            }
                $footer->logo = $nombreFoto;
                $footer->save();
                $nuevaFoto->storeAs('public', $nombreFoto);
        }

        $user = User::find(1);
        // Actualizar los datos del modelo Footer con la data del request
        $footer->title = $request->input('title');
        $footer->content = $request->input('content');
        $footer->email = $request->input('email');
        $footer->phone = $request->input('phone');
        $footer->order_message = $request->input('order_message');
        $footer->address = $request->input('address');

        // Guardar los cambios en la base de datos
        $footer->save();
        // Guardando las redes sociales de lodomens (admin)
        $redesSociales = $request->input('redes');
        if (!empty($redesSociales)) {
            foreach ($redesSociales as $redSocialData) {
                $nombre = $redSocialData['\'name\''];
                $url = $redSocialData['\'url\''];

                // Primero, verifica si el usuario ya tiene una red social con el mismo nombre

                $redSocialExistente = $user->socialMedia()->where('name', $nombre)->first();

                if ($redSocialExistente) {
                    // Si la red social ya existe, actualiza su URL
                    $redSocialExistente->update(['url' => $url]);
                    if ($redSocialExistente->url === null) {
                        $redSocialExistente->delete();
                    }
                } else {
                    // Verifica si $redSocialExistente es null y si el campo 'url' no es nulo o vacío
                    if ($redSocialExistente === null && $url !== null && $url !== '') {
                        $user->socialMedia()->create([
                            'name' => $nombre,
                            'url' => $url,
                        ]);
                    }
                }
            }
            $nombresRedes = collect($redesSociales)->pluck('\'name\'');
            $user->socialMedia()
                ->whereNotIn('name', $nombresRedes)
                ->delete();
            } else {
                $user->socialMedia()->delete(); }

                return redirect()->route('mypage.edit')->with('info','Se actualizarón los datos del usuario');
            }
        }
