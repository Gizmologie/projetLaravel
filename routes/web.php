<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Front\CatalogueController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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
Route::get('/home', function () {
    return redirect()->route('home');
});
Route::get('/recherche', [CatalogueController::class, 'list'])->name('search');
Route::get('/testMail', [ProductController::class, 'testMail']);

// Route produit
Route::get('/produit/{category}/{slug}', [ProductController::class, 'productDetails'])->name('productDetails');

// Route Commentaire
Route::post('storeComment/{product_id}', [CommentController::class, 'storeComment'])->name('storeComment');
Route::delete('deleteComment/{id}', [CommentController::class, 'removeComment'])->name('deleteComment');

// Route utilisateur
Route::get('/mon-compte', [UserController::class, 'profil'])->name('profil');
Route::get('/modification-du-mot-de-passe', [UserController::class, 'updatePassword'])->name('updatePassword');
Route::post('changement-du-mot-de-passe', [UserController::class, 'changePassword'])->name('passwordChange');
Route::get('/mes-commandes/commande/{id}', [UserController::class, 'orderShow'])->name('userOrderShow');
Route::get('/mes-commandes/telechargement/{id}', [UserController::class, 'orderDownload'])->name('userOrderDownload');
// Route administration

Route::group(['middleware' => ['admin']], function () {

// Administation User
Route::get('/admin/utilisateur', [AdminUserController::class, 'indexUser'])->name('adminUser');
Route::get('/admin/utilisateur/details/{id}', [AdminUserController::class, 'detailsUser'])->name('detailsUser'); // route vers page
Route::get('/admin/utilisateur/ajouter', [AdminUserController::class, 'createUser'])->name('createUser');
Route::post('/admin/utilisateur/enregistrer', [AdminUserController::class, 'storeUser'])->name('storeUser');
Route::post('/admin/utilisateur/modifier/{id}', [AdminUserController::class, 'updateUser'])->name('updateUser');
Route::delete('/admin/utilisateur/supprimer/{id}', [AdminUserController::class, 'removeUser'])->name('deleteUser');

// Administration Product
Route::get('/admin/product', [AdminProductController::class, 'indexProduct'])->name('adminProduct');
Route::get('/admin/product/ajouter', [AdminProductController::class, 'createProduct'])->name('createProduct');
Route::post('/admin/product/enregistrer', [AdminProductController::class, 'storeProduct'])->name('storeProduct');
Route::get('/admin/product/details/{id}', [AdminProductController::class, 'detailsProduct'])->name('detailsProduct');
Route::post('/admin/product/modifier/{id}', [AdminProductController::class, 'updateProduct'])->name('updateProduct');
Route::delete('/admin/product/supprimer/{id}', [AdminProductController::class, 'removeProduct'])->name('deleteProduct');
});

Route::get('/cart/deleteLine', [CartController::class, 'deleteLine']);
Route::get('/cart/updateLine', [CartController::class, 'addLine']);
Route::get('/cart/loadCart', [CartController::class, 'loadCart']);

// Route authentification
Route::post('/resetPasswordWithToken', [AccountController::class, 'resetPasswordWithToken'])->name('resetPasswordWithToken');
Route::get('/reset/{token}', [AccountController::class, 'changePasswordLink'])->name('changePasswordLink');
Route::post('/resetPassword', [AccountController::class, 'resetPassword'])->name('resetPassword');

// Route panier
Route::get('/cart', [CartController::class, 'index'])->name('cart');

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
