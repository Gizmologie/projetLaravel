<?php

use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/setToHome', 'HomeController@setToHome')->name('setToHome'); // ne fonctionne pas

Route::get('/', [ProductController::class, 'list']);
Route::get('/testMail', [ProductController::class, 'testMail']);

// Route administration
Route::get('/adminUser', 'AdminController@indexUser')->name('adminUser');
Route::get('/detailsUser/{id}', 'AdminController@detailsUser')->name('detailsUser');
Route::get('/adminProduct', 'AdminController@indexProduct')->name('adminProduct');
Route::get('/adminUser/{id}', 'AdminController@getDetailsUser')->name('getDetailsUser');
Route::post('admin/{id}/updateUser', 'AdminController@updateUser')->name('updateUser');
Route::delete('/deleteUser/{id}', 'AdminController@remove')->name('deleteUser');




Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('setToHome');
})->name('logout');


Auth::routes();
