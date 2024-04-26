<?php

use App\Http\Controllers\FooterController;
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
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\TypesController;
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
    return view('web.index');
})->name('root');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('tienda',[WebShopController::class,'index'])->name('web.shop.index');
Route::get('tienda/{product}/{color}',[WebShopController::class,'show'])->name('web.shop.show');
Route::get('registro',[WebController::class,'login_register'])->name('web.login_register');
Route::post('registro/user',[WebController::class,'register_user'])->name('web.store_register');
Route::get('recuperar_password',[WebController::class,'recover_password'])->name('web.recover_password');
Route::get('color/product/get',[WebShopController::class,'getimage'])->name('getimage.product.select');
Route::get('cart',[CartController::class,'index'])->name('cart.index');
Route::get('checkout',[CheckoutController::class,'index'])->name('checkout.index');
Route::middleware(['auth', config('jetstream.auth_session'),'verified',
])->group(function () {
    /* Route::get('home',[HomeController::class,'index'])->name('home'); */
    Route::get('panel/wishlist',[WishlistController::class,'index'])->name('webdashboard.wishlist');
    Route::get('panel/pefil',[WishlistController::class,'profile'])->name('webdashboard.profile');
    Route::prefix('admin')->group(function(){
        Route::get('footer',[FooterController::class,'edit'])->name('mypage.edit');
        Route::put('footer/{id}',[FooterController::class,'update'])->name('mypage.update');
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

    });

});
