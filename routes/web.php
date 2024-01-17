<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WebShopController;
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
Route::get('tienda/{product}',[WebShopController::class,'show'])->name('web.shop.show');
Route::middleware(['auth', config('jetstream.auth_session'),'verified',
])->group(function () {
    Route::get('home',[HomeController::class,'index'])->name('home');
    Route::prefix('admin')->group(function(){
        Route::resource('roles', RoleController::class)->names('roles');
        Route::resource('users', UserController::class)->names('users');
        Route::resource('categories', CategoryController::class)->names('categories');
        Route::resource('tags', TagController::class)->except('show')->names('tags');
        Route::get('tag/{type}',[TagController::class,'type'])->name('tags.indextype');
        Route::resource('posts',PostController::class)->except('create')->names('posts');
        Route::get('category/product',[CategoryController::class,'index_product'])->name('categories.PRODUCT');

        Route::prefix('blog')->group(function(){
            Route::get('category/post',[CategoryController::class,'index_post'])->name('POST.categories');
            Route::get('category/post/create',[CategoryController::class,'create_post'])->name('POST.categories.create');
            Route::post('upload_image/{id}',[PostController::class,'upload_image'])->name('upload.image');
            Route::get('get_images/{id}',[PostController::class, 'get_images'])->name('get.images');
            Route::delete('upload_image/{id}/delete',[PostController::class,'file_delete'])->name('file.delete');
        });
    });

});
