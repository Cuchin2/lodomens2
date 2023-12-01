<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:roles.index',
            'permission:roles.show'
        ]);

    }

    public function index()
    {
        $roles= Role::get();
        return view('admin.role.index');
    }

    public function create()
    {
        $permissions= Permission::get();
        return view('admin.role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        /* $role->permissions()->sync($request->permissions, null, 'sanctum'); */
        return redirect()->route('roles.edit',$role)->with('info','El rol se creó con éxito');
    }

    public function show(Role $role)
    {
        return view('admin.role.show',compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions= Permission::get();
        $tieneTodosLosPermisos = $role->permissions->count() == Permission::count();
        return view('admin.role.edit',compact('role','permissions','tieneTodosLosPermisos'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.edit',$role)->with('info','El rol se actualizó con éxito');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('info','El rol se eliminó con éxito');
    }
}
