<?php

use App\Http\Controllers\Front\CatalogueController;
use App\Http\Controllers\Front\IndexController;
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

Route::get('/', [CatalogueController::class, 'list'])->name('home');
Route::get('/recherche', [CatalogueController::class, 'list'])->name('search');
Route::get('/testMail', [ProductController::class, 'testMail']);

// Route produit
Route::get('/productDetails/{id}', [ProductController::class, 'productDetails'])->name('productDetails');


// Route utilisateur
Route::get('/profil/{id}', 'UserController@profil')->name('profil');

// Route administration
// Administation User
Route::get('/adminUser', 'AdminController@indexUser')->name('adminUser');
Route::get('/detailsUser/{id}', 'AdminController@detailsUser')->name('detailsUser');
Route::get('/adminUser/{id}', 'AdminController@getDetailsUser')->name('getDetailsUser'); // Possiblement obsolete
Route::get('/createUser', 'AdminController@createUser')->name('createUser');
Route::post('/storeUser', 'AdminController@storeUser')->name('storeUser');
Route::post('admin/{id}/updateUser', 'AdminController@updateUser')->name('updateUser');
Route::delete('/deleteUser/{id}', 'AdminController@removeUser')->name('deleteUser');

// Administration Product
Route::get('/adminProduct', 'AdminController@indexProduct')->name('adminProduct');
Route::get('/detailsProduct/{id}', 'AdminController@detailsProduct')->name('detailsProduct');
Route::post('admin/{id}/updateProduct', 'AdminController@updateProduct')->name('updateProduct');
Route::delete('/deleteProduct/{id}', 'AdminController@removeProduct')->name('deleteProduct');

// Route authentification
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');


Auth::routes();
