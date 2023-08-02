<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Negocio\CategoriaProductoController;
use App\Http\Controllers\Admin\NegocioController;
use App\Http\Controllers\Negocio\ProductoController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Negocio\BannerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('sendNegocios', [NegocioController::class, 'store']); //Mostrar todo los registros de NEGOCIOS
Route::get('listcategorias', [CategoriaController::class, 'index']); //Mostrar todas las CATEGORIAS de los NEGOCIOS

Route::post('register', [ClienteController::class, 'register']); //Registrar CLIENTE
Route::post('login', [ClienteController::class, 'login']); //Iniciar sesión CLIENTE

Route::post('sendNotification', [ClienteController::class, 'sendNotification']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [ClienteController::class, 'logout']); //Cerrar sesión CLIENTE
    Route::put('update/{id}', [ClienteController::class, 'update']); //Actualizar CLIENTE

    Route::get('negocios', [NegocioController::class, 'index']); //Mostrar todo los registros de NEGOCIOS
    Route::get('categoriasNegocio', [CategoriaController::class, 'index']); //Mostrar todas las CATEGORIAS de los NEGOCIOS
    Route::get('categoriaProductos/{id}', [CategoriaProductoController::class, 'show']); //Mostrar las CATEGORÍAS de PRODUCTOS por NEGOCIO
    Route::get('productos/{id}', [ProductoController::class, 'index']); //Obtener PRODUCTOS por NEGOCIO
    Route::get('banners/{id}', [BannerController::class, 'show']); //Mostrar todos los Banners por NEGOCIO

   /*  Route::post('sendNotification', [ClienteController::class, 'sendNotification']); */

});
