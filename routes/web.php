<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Front\CatalogueController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\OrderController;
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
Route::get('/home', function(){
    return redirect()->route('home');
});
Route::get('/recherche', [CatalogueController::class, 'list'])->name('search');
Route::get('/testMail', [ProductController::class, 'testMail']);

// Route produit
Route::get('/produit/{category}/{slug}', [ProductController::class, 'productDetails'])->name('productDetails');

// Route Commentaire
Route::post('storeComment/{product_id}', 'CommentController@storeComment')->name('storeComment');
Route::delete('deleteComment/{id}', 'CommentController@removeComment')->name('deleteComment');

// Route utilisateur
//Route::get('/profil/{id}', 'UserController@profil')->name('profil');
Route::get('/profil', 'UserController@profil')->name('profil');
Route::get('/updatePassword/{id}', 'UserController@updatePassword')->name('updatePassword');
Route::post('changePassword/{id}', 'UserController@changePassword')->name('passwordChange');

// Route administration

Route::group(['middleware' => ['admin']], function () {
    // Administation User
    Route::get('/admin/user', 'AdminUserController@indexUser')->name('adminUser');
    Route::get('/admin/user/details/{id}', 'AdminUserController@detailsUser')->name('detailsUser'); // route vers page
    Route::get('/admin/user/create', 'AdminUserController@createUser')->name('createUser');
    Route::post('/admin/user/store', 'AdminUserController@storeUser')->name('storeUser');
    Route::post('/admin/user/update/{id}', 'AdminUserController@updateUser')->name('updateUser');
    Route::delete('/admin/user/delete/{id}', 'AdminUserController@removeUser')->name('deleteUser');

    // Administration Product
    Route::get('/admin/product', 'AdminProductController@indexProduct')->name('adminProduct');
    Route::get('/admin/product/create', 'AdminProductController@createProduct')->name('createProduct');
    Route::post('/admin/product/store', 'AdminProductController@storeProduct')->name('storeProduct');
    Route::get('/admin/product/details/{id}', 'AdminProductController@detailsProduct')->name('detailsProduct');
    Route::post('/admin/product/update/{id}', 'AdminProductController@updateProduct')->name('updateProduct');
    Route::delete('/admin/product/delete/{id}', 'AdminProductController@removeProduct')->name('deleteProduct');
});


Route::get('/cart/deleteLine', [CartController::class, 'deleteLine']);
Route::get('/cart/updateLine', [CartController::class, 'addLine']);
Route::get('/cart/loadCart', [CartController::class, 'loadCart']);


// Route authentification
Route::post('/mailResetPassword', 'AdminController@mailResetPassword')->name('mailResetPassword');
Route::post('/resetPasswordWithToken', 'AccountController@resetPasswordWithToken')->name('resetPasswordWithToken');
Route::get('/reset/{token}', 'AccountController@changePasswordLink')->name('changePasswordLink');
Route::post('/resetPassword', 'AccountController@resetPassword')->name('resetPassword');


// Route panier
Route::get('/cart', 'CartController@index')->name('cart');

// Route commande
Route::get('/commande/livraison', [OrderController::class, 'step1'])->name('orderStep1');
Route::post('/commande/livraison/validation', [OrderController::class, 'step1Confirm'])->name('orderStep1Confirm');
Route::get('/commande/paiement', [OrderController::class, 'step2'])->name('orderStep2');
Route::get('/commande/terminee', [OrderController::class, 'step3'])->name('orderStep3');
Route::get('/commande/session', [OrderController::class, 'session'])->name('orderSession');



// Route authentification
Route::get('/login', function () {
    Auth::login();
    return redirect()->route('home');
})->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');


Auth::routes();
