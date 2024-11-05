<?php

use App\Http\Controllers\FooterController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\TiendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WebShopController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaidController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\GraciasController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\StockController;
use App\Models\Address;
use App\Models\SaleOrder;

/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.proximamente');
});

Route::get('inicio',[MainController::class,'index'])->name('root');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'home.permission', // Aplica el middleware aquí
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/usd/{name}', [DashboardController::class, 'usd'])->name('dashboard.usd');
});
Route::get('tienda',[WebShopController::class,'index'])->name('web.shop.index');
Route::get('tienda/{product}/{color}',[WebShopController::class,'show'])->name('web.shop.show');
Route::get('sku/{id}/{color}',[TiendaController::class,'skus'])->name('get.skus');
Route::post('addcart',[TiendaController::class,'addcart'])->name('addcart');
Route::get('registro',[WebController::class,'login_register'])->name('web.login_register');
Route::post('registro/user',[WebController::class,'register_user'])->name('web.store_register');
Route::get('recuperar_password',[WebController::class,'recover_password'])->name('web.recover_password');
Route::get('color/product/get',[WebShopController::class,'getimage'])->name('getimage.product.select');
Route::get('cart',[CartController::class,'index'])->name('web.shop.cart.index');
Route::get('contacto',[WebController::class,'contact'])->name('web.contact.index');
Route::post('email',[MailController::class, 'index'])->name('email');



Route::middleware(['auth', config('jetstream.auth_session'),'verified', ])->group(function () {
    /* Route::get('home',[HomeController::class,'index'])->name('home'); */

    Route::prefix('admin')->group(function(){
        Route::get('slider',[InicioController::class,'index'])->name('mypage.main');
        Route::put('banner/update/{id}',[InicioController::class,'update'])->name('banner.update');
        Route::put('banner/update/sort/{id}',[InicioController::class,'sort'])->name('banner.sort');
        Route::put('about/update/{id}',[InicioController::class,'about'])->name('about.update');
        Route::get('footer',[FooterController::class,'edit'])->name('mypage.edit');
        Route::put('footer/{id}',[FooterController::class,'update'])->name('mypage.update');
        Route::resource('contact',ContactController::class)->names('mypage.contact');
        Route::get('shipping',[InicioController::class,'shipping'])->name('mypage.shipping');
        Route::resource('roles', RoleController::class)->names('roles');
        Route::resource('users', UserController::class)->names('users');
        Route::post('color/product/upload/{product}',[ColorController::class,'upload'])->name('upload.product.color');
        Route::get('color/product/get',[ColorController::class,'getimage'])->name('getimage.product.color');
        Route::post('row/{product}',[ColorController::class,'addrow'])->name('row.product.image');
        Route::post('sorting/{product}',[ColorController::class,'sorting'])->name('sorting.image');
        Route::delete('deleteimage/color/{product}',[ColorController::class,'deleteimage'])->name('deleteimage.color');
        Route::delete('row/delete/{product}',[ColorController::class,'deleterow'])->name('deleterow');
            Route::resource('products', ProductController::class)->names('inventory.products');
            Route::resource('color',ColorController::class)->names('inventory.colors');
            Route::resource('type',TypesController::class)->names('inventory.types');
            Route::resource('brand',BrandController::class)->names('inventory.brands');
            Route::resource('categories', CategoryController::class)->names('inventory.categories');
            Route::resource('tags', TagController::class)->except('show')->names('inventory.tags');
        Route::get('tag/{type}',[TagController::class,'type'])->name('tags.indextype');
        Route::get('category/product',[CategoryController::class,'index_product'])->name('categories.PRODUCT');
        Route::get('getimages/{product}',[ProductController::class,'getimages'])->name('getimages');
        Route::post('addimages/{product}',[ProductController::class,'addimages'])->name('addimages');
        Route::delete('deleteimage/{product}',[ProductController::class,'deleteimage'])->name('deleteimage');
        Route::post('handleReorder/{product}',[ProductController::class,'handleReorder'])->name('handleReorder');
        Route::get('sales',[SaleController::class, 'index'])->name('sale.index');
        Route::get('sales/{id}',[SaleController::class, 'show'])->name('sale.show');

    });
    Route::get('panel/wishlist',[WishlistController::class,'index'])->name('web.shop.webdashboard.wishlist');
    Route::get('panel/perfil',[WishlistController::class,'profile'])->name('web.shop.webdashboard.profile');
    Route::get('panel/direcciones',[WishlistController::class,'address'])->name('web.shop.webdashboard.address');
    Route::get('panel/compras',[WishlistController::class,'purchase'])->name('web.shop.webdashboard.purchase');
    Route::get('panel/account',[WishlistController::class,'account'])->name('web.shop.webdashboard.account');
    Route::post('panel/uploadPhoto',[WishlistController::class,'uploadPhoto'])->name('web.shop.webdashboard.uploadphoto');


    Route::get('checkout',[CheckoutController::class,'index'])->name('web.shop.checkout.index');
    Route::post('checkout/crear',[CheckoutController::class,'create'])->name('checkout.create');
    Route::post('para_pagar',[CheckoutController::class,'topay'])->name('web.shop.checkout.forpay');
    Route::get('pagos',[CheckoutController::class,'pays'])->name('web.shop.checkout.pay');
    Route::get('envios',[CheckoutController::class,'shipping'])->name('web.shop.checkout.shipping');
    Route::post('paid/izipay',[PaidController::class,'izipay'])->name('paid.izipay');
    Route::post('paid/niubiz',[PaidController::class,'niubiz'])->name('paid.niubiz');
    Route::post('/paid/create-paypal-order',[PaidController::class,'createPaypalOrder'])->name('paid.createPaypalOrder');
    Route::post('/paid/capture-paypal-order',[PaidController::class ,'capturePaypalOrder'])->name('paid.capturePaypalOrder');
    Route::get('/paid/mercadopago',[PaidController::class ,'mercadopago'])->name('paid.mercadopago');
    Route::get('/gracias',[GraciasController::class, 'gracias'])->name('web.shop.gracias');

    // API de Pais/Departamento/Ciudad/Distrito
    Route::get('/api/countries', [LocationController::class, 'getCountries']);
    Route::get('/api/states/{countryCode}', [LocationController::class, 'getStates']);
    Route::get('/api/cities/{stateCode}', [LocationController::class, 'getCities']);
    Route::get('/api/distrits/{cityCode}', [LocationController::class, 'getDistrits']);

    Route::post('restock',[StockController::class,'restock'])->name('restock');

    Route::get('luchin',function(){
        $order = SaleOrder::where(['user_id'=>auth()->user()->id,'status'=>'PAID'])->with('saleDetails')->orderBy('created_at','desc')->first();
        $mailData['email']=env('MAIL_FROM_ADDRESS');
        $mailData['name']=env('APP_NAME');
        $mailData['order']=$order;
        $mailData['subject']='Gracias por su compra';
        $mailData['cartItems']=$order->saleDetails;
        $mailData['shipping']=$order->shipping;
        $mailData['deliveryOrders']=$order->deliveryOrders;

        return view('emails.incomingMail',compact('mailData'));
    })->name('luchin');

});

Route::get('bienvenido',[WelcomeController::class,'bienvenido']);
Route::get('verificar',[WelcomeController::class,'verificar'])->name('verified');

/*         $get= Address::where('user_id',auth()->user()->id)->get() ?? '';
    $get2= Address::where(['user_id'=>auth()->user()->id,'current'=>1])->first()->name ?? '';
    $datosCombinados = [
        'get' => $get,
        'get2' => $get2,
    ];

    return response()->json($datosCombinados); */
Route::get('pruebas',[PruebaController::class ,'pruebas']);
Route::get('permisos',[PruebaController::class ,'permission']);
