<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Setting;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        $banners=Banner::orderBy('order','asc')->get();

        if ($banners->count() < 3) {
            if ($banners->count() == 1) {
                // Crear un elemento con valores vacíos si solo hay un elemento en la tabla
                Banner::create([
                    'url' => '',
                    'href' => '',
                    'title' => '',
                    'order' => $banners->last()->order == 1 ? 0 : 1, // Ajusta el valor de 'order' según sea necesario
                ]);
            } elseif ($banners->count() == 0) {
                // Crear dos elementos con valores vacíos si no hay elementos en la tabla
                Banner::create([
                    'url' => '',
                    'href' => '',
                    'title' => '',
                    'order' => 0, // Ajusta el valor de 'order' según sea necesario
                ]);
                Banner::create([
                    'url' => '',
                    'href' => '',
                    'title' => '',
                    'order' => 1, // Ajusta el valor de 'order' según sea necesario
                ]);
            }
            $about=Setting::where('action','about')->first();
        }
        return view('admin.mypage.main',compact('banners','about'));
    }
    public function update(Request $request, $id)
    {
        $banner = Banner::where('order',$id)->first();
        //Actualizando la foto
        if ($request->hasFile('photo')) {
            // Lógica para guardar la nueva foto
            $nuevaFoto = $request->file('photo');
            $nombreFoto = uniqid() . '.' . $nuevaFoto->getClientOriginalExtension();
            $fotoAnterior = $banner->url;
            if ($fotoAnterior) {
                // Eliminar la foto anterior del almacenamiento
                $filePath = storage_path('app/public/'.$fotoAnterior);
                unlink($filePath);
            }
                $banner->url = $nombreFoto;
                $banner->save();
                $nuevaFoto->storeAs('public', $nombreFoto);
        }

        // Actualizar los datos del modelo Footer con la data del request
        $banner->title = $request->input('title');
        $banner->href = $request->input('href');

        // Guardar los cambios en la base de datos
        $banner->save();
        return redirect()->route('mypage.main')->with('info','Se actualizarón los datos de los banners');
    }

    public function sort(Request $request,$id)
    {
        $old= Banner::where('order',$request->position+1)->first();
        $new= Banner::find($id);  $new_order= $new->order;
        $new->order=$request->position+1;  $new->save();
        $old->order= $new_order;   $old->save();
    }
    public function about(Request $request)
    {
        Setting::updateOrCreate(
            ['action' => 'about'], // Condiciones de búsqueda
            ['description' => $request->description,
              'name'=> $request->name,
              'action'=>'about'
            ] // Valores a actualizar o crear
        );
        return redirect()->route('mypage.main')->with('info','Se actualizarón los datos sobe nosotros');
    }
}
