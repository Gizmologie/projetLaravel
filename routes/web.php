<?php

use App\Http\Controllers\Front\CatalogueController;
use App\Http\Controllers\Front\IndexController;
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

Route::get('/', [IndexController::class, 'index']);
Route::get('/recherche', [CatalogueController::class, 'list'])->name('search');
Route::get('/testMail', [ProductController::class, 'testMail']);
