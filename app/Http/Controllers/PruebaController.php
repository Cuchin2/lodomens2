<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function pruebas()
        {
            return view('pruebas');
        }
    public function permission()
    {
        Permission::create([
            'name'=>'mypage.main.index',
            'type'=>'configuration',
            'description'=>'Acceder a la edición de inicio'
        ]);
        Permission::create([
            'name'=>'mypage.contact.index',
            'type'=>'configuration',
            'description'=>'Acceder a la edición de contacto'
        ]);
        Permission::create([
            'name'=>'mypage.edit',
            'type'=>'configuration',
            'description'=>'Acceder a la edición del footer'
        ]);
        Permission::create([
            'name'=>'mypage.main.shipping',
            'type'=>'configuration',
            'description'=>'Acceder a la edición de métodos de envio'
        ]);
        Permission::create([
            'name'=>'inventory.types.index',
            'type'=>'configuration',
            'description'=>'Acceder a la edición de productos especiales'
        ]);
        Permission::create([
            'name'=>'inventory.brands.index',
            'type'=>'configuration',
            'description'=>'Acceder a la edición de marcas'
        ]);
        Permission::create([
            'name'=>'inventory.colors.index',
            'type'=>'configuration',
            'description'=>'Acceder a la edición de colores'
        ]);
        Permission::create([
            'name'=>'roles.edit',
            'type'=>'configuration',
            'description'=>'Acceder a la edición de permisos'
        ]);
        return 'se crearon los permisos';
    }
}
