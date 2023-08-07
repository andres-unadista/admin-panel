<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use sisVentas\Http\Controllers\ArticleController;
use sisVentas\Http\Controllers\CategoryController;
use sisVentas\Http\Controllers\ClientController;
use sisVentas\Http\Controllers\IncomeController;
use sisVentas\Http\Controllers\ProviderController;
use sisVentas\Http\Controllers\SaleController;
use sisVentas\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('/productos/categoria', CategoryController::class)->middleware('auth');
Route::resource('/productos/articulo', ArticleController::class)->middleware('auth');
Route::resource('/ventas/cliente', ClientController::class, ['names' => 'sales.client'])->middleware('auth');
Route::resource('ventas/proveedor', ProviderController::class, ['names' => 'sales.provider'])->middleware('auth');
Route::resource('compras/ingresos', IncomeController::class, ['names' => 'sales.income'])->middleware('auth');
Route::resource('ventas/venta', SaleController::class, ['names' => 'sales.sale'])->parameters([
    'venta' => 'sale'
]);

Route::resource('seguridad/usuario', UserController::class, ['names' => 'security.user'])->parameters([
    'usuario' => 'user'
]);


Route::get('/home', [sisVentas\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


Auth::routes();

Route::get('/{slug?}', [sisVentas\Http\Controllers\HomeController::class, 'index']);
