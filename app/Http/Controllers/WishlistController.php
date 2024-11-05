<?php

namespace App\Http\Controllers;
use App\Models\SaleOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cart;
class WishlistController extends Controller
{
    public function index()
    {   if(auth()->user())
        {
        Cart::instance('wishlist')->destroy();
        Cart::instance('wishlist')->restore(auth()->user()->id);
        }
        return view('web.cart.wishlist');
    }
    public function profile()
    {
        return view('web.dashboard.profile');
    }
    public function address()
    {
        return view('web.dashboard.address');
    }
    public function purchase(Request $request)
    {
        $order_user= SaleOrder::where('user_id',auth()->user()->id)->where('status','PAID')->latest()->first();
        return view('web.dashboard.purchase',['open'=>($request->open ?? ''),'order_last'=>$request->open ?? '1']);
    }
    public function account(Request $request)
    {
        return view('web.dashboard.account',[
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
    public function uploadPhoto(Request $request) {
            $base64Image = $request->input('profile_photo_url');
    $user = User::find(auth()->user()->id);
    $older_image =  'profile-photos/'.basename($user->profile_photo_path);
    // Comprueba si la imagen existe en la carpeta 'profile-photos/'
    if (Storage::disk('public')->exists($older_image)) {
        // Elimina la imagen anterior
        Storage::disk('public')->delete($older_image);
    }

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

        $user->profile_photo_path =$path;
        $user->save();
        return response()->json($path, 200); // 201 Created
    }
}
