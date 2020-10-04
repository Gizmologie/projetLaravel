<?php

use App\Http\Controllers\Front\ProductController;
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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', [ProductController::class, 'list']);
Route::get('/testMail', [ProductController::class, 'testMail']);

// Route administration
Route::get('/adminUser', 'AdminController@indexUser')->name('adminUser');
Route::get('/adminProduct', 'AdminController@indexProduct')->name('adminProduct');


Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
});


