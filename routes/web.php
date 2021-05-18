<?php

use App\Http\Controllers\CustomController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('setlocale/{locale}', function ($lang) {
    session()->put('locale', $lang);
    return redirect()->back();
})->name('setlocale');

Route::group(['middleware' => 'language'], function () {
    Route::get('/', 'GuestController@welcome')->name('welcome');

    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@process_login')->name('login');
    Route::get('/register', 'AuthController@register')->name('register');
    Route::post('/register', 'AuthController@process_signup');
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::resource('product', 'ProductController')->names('products');

    Route::prefix('products')->group(function () {
        Route::get('/like/{product}',  [ProductController::class, 'isLiked'])->name('products.like');
        Route::get('/search/',  [ProductController::class, 'search'])->name('products.search');
    });

    Route::middleware(['user'])->group(function () {
        // 
    });

    Route::middleware(['vendor'])->group(function () {
        //
    });

    Route::middleware(['admin'])->group(function () {
        Route::prefix('products')->group(function () {
            Route::get('/trash/',  [CustomController::class, 'trash'])->name('products.trash');
            Route::get('/show-trashed/{product_id}',  [CustomController::class, 'showTrashed'])->name('products.showTrashed');
            Route::get('/{product}/restore',  [CustomController::class, 'restore'])->name('products.restore');
            Route::get('/destroy-permanently/{product}',  [CustomController::class, 'destroyPermanent'])->name('products.destroyPermanent');
        });
    });
});
