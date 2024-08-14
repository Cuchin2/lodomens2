<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class WebController extends Controller
{

    /* ==================== FIN DE BLOG ===================== */
    public function about_us()
    {
        return view('client.about_us');
    }
    public function cart()
    {
        return view('web.cart');
    }
    public function contact()
    {
        $contacts=Contact::orderBy('order','asc')->get();
        return view('web.contact.index',compact('contacts'));
    }
    public function login_register()
    {
        return view('web.register');
    }
    public function subcription_email(StoreSubscriptionRequest $request){

            Subscription::create([
                'email' => $request->subscription_email
            ]);
            return back()->with('mensaje','se ha suscrito correctamente');
    }
    public function login_error(){
        return redirect()->route('web.login_register')->with('login_messages','Es necesario iniciar sesión para dejar un comentario');
    }
    public function register_user(StoreRequest $request){
        $base64Image = $request->input('profile_photo_url');

                if (preg_match('/^data:image\//', $base64Image)) {
                            // Analiza el encabezado para determinar el tipo de imagen
                            preg_match('/data:image\/(.*?);/', $base64Image, $matches);
                            $imageType = $matches[1];

                            // Extrae los datos base64
                            $data = substr($base64Image, strpos($base64Image, ',') + 1);

                            // Decodifica los datos base64 en una cadena binaria
                            $imageData = base64_decode($data);
                            // Genera un nombre de archivo único
                            $filename = $request->input('name') . time() . '.' . $imageType;
                            // Guarda la imagen en el sistema de archivos
                            $path = 'profile-photos/' . $filename;
                            Storage::disk('public')->put($path, $imageData);
                } else {
                    $path = parse_url($base64Image)['path'];
                    $path = str_replace("/storage", "", $path);
                }

            $user= new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->last_name = $request->input('last_name');
            $user->profile_photo_path = $path;
            $user->user_type_id = 3;
            $user->assignRole('Client')->save();
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->save();
            $user->sendEmailVerificationNotification();
            // Autentica al usuario
            Auth::login($user);
            return redirect()->route('root');
    }
    public function recover_password()
    {
        return view('web.forgotpassword');
    }
}
