<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PedidosController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});



/*Route::get('/articulo', function () {
    return view('articulo.index');
});
Route::get('/articulo/create',[ArticuloController::class,'create']);
*/

Route::resource('proveedor', ProveedorController::class)->middleware('auth');
Route::resource('articulo', ArticuloController::class)->middleware('auth');
Route::resource('pedido', PedidosController::class)->middleware('auth');
//Auth::routes(['register'=>false,'reset'=>false]);
Auth::routes();

Route::get('/home', [ProveedorController::class, 'index'])->name('home');
Route::get('/home', [ArticuloController::class, 'index'])->name('home');
Route::get('/home', [PedidosController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [ArticuloController::class, 'index'])->name('home');   
    Route::get('/', [ProveedorController::class, 'index'])->name('home');
    Route::get('/', [PedidosController::class, 'index'])->name('home');  
    
});