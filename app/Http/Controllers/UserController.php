<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SocialMediaUser;
use App\Http\Requests\User\StoreRequest;
use App\http\Requests\User\UpdateRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:users.index',
            'permission:users.create',
            'permission:users.store',
            'permission:users.show',
            'permission:users.edit',
            'permission:users.update',
            'permission:users.destroy',
            'permission:web.update_client',
            'permission:web.update_password',
        ]);
    }

    public function index()
    {
        $users=User::all();
        return view('admin.user.index',compact('users'));
    }

    public function create(User $user)
    {
        $roles = Role::all();

        return view('admin.user.create', compact('user','roles'));
            }


    public function store(StoreRequest $request,User $user)
    {

        $user=User::create($request->all());
        $user->roles()->sync($request->roles);
        $user->update(['password' => Hash::make($request->password)]);
        $user->profile()->create([
            'description' => $request->description,
            'last_name'=> $request->last_name,
            'dni'=> $request->dni,
            'ruc'=> $request->ruc,
            'address'=> $request->address,
            'birthday'=> $request->birthday,
            'phone'=> $request->phone,
        ]);
        $redesSociales = $request->input('redes');
        if (!empty($redesSociales)) {
            foreach ($redesSociales as $redSocialData) {
                $nombre = $redSocialData['\'name\''];
                $url = $redSocialData['\'url\''];
                $user->socialMedia()->create([
                    'name' => $nombre,
                    'url' => $url,
                ]);
            }
        }
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $total_purchases = 0;
        foreach ($user->sales as $key =>  $sale) {
            $total_purchases+=$sale->total;
        }
        $total_amount_sold = 0;
        foreach ($user->purchases as $key =>  $purchase) {
            $total_amount_sold+=$purchase->total;
        }
        return view('admin.user.show', compact('user', 'total_purchases', 'total_amount_sold'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('socialMedia');
        return view('admin.user.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->except('password'));
        if (!empty($request->password)) {
        $user->update(['password' => Hash::make($request->password)]);
         }
        $user->profile()->update([
            'description' => $request->description,
            'last_name'=> $request->last_name,
            'dni'=> $request->dni,
            'ruc'=> $request->ruc,
            'address'=> $request->address,
            'birthday'=> $request->birthday,
            'phone'=> $request->phone,
        ]);
        $user->roles()->sync($request->roles);

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

        return redirect()->route('users.edit',$user)->with('info','Se actualizarón los datos del usuario');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
    public function update_client(Request $request,User $user){
        $user->update_client($request);
        return back();
    }
    public function update_password(Request $request,User $user){

        $request->validate([
            'current_password' => 'required',
            'newPassword' => 'required|same:passwordConfirmation|min:6',
            'passwordConfirmation' => 'required',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password'=>'las contraseñas no coinciden']);
        }
        else {
        $user->update(['password' => Hash::make($request->newPassword)]);
        return redirect()->back()->with('success','password successfully');
            }
    }
}
