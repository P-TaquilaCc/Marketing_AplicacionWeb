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

Route::post('sendNegocios', [NegocioController::class, 'store']); //Guardar el NEGOCIO - LANDING PAGE
Route::get('listcategorias', [CategoriaController::class, 'index']); //Mostrar todas las CATEGORIAS de los NEGOCIOS - LANDING PAGE
Route::get('listNegocios' , [NegocioController::class, 'listNegocios']);

Route::post('register', [ClienteController::class, 'register']); //Registrar CLIENTE - APP
Route::post('login', [ClienteController::class, 'login']); //Iniciar sesión CLIENTE - APP

Route::post('sendNotification', [ClienteController::class, 'sendNotification']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [ClienteController::class, 'logout']); //Cerrar sesión CLIENTE - APP
    Route::put('update/{id}', [ClienteController::class, 'update']); //Actualizar CLIENTE - APP

    Route::get('negocios', [NegocioController::class, 'index']); //Mostrar todo los registros de NEGOCIOS - APP
    Route::get('categoriasNegocio', [CategoriaController::class, 'index']); //Mostrar todas las CATEGORIAS de los NEGOCIOS - APP
    Route::get('categoriaProductos/{id}', [CategoriaProductoController::class, 'show']); //Mostrar las CATEGORÍAS de PRODUCTOS por NEGOCIO - APP
    Route::get('productos/{id}', [ProductoController::class, 'index']); //Obtener PRODUCTOS por NEGOCIO - APP
    Route::get('banners/{id}', [BannerController::class, 'show']); //Mostrar todos los Banners por NEGOCIO - APP

   /*  Route::post('sendNotification', [ClienteController::class, 'sendNotification']); */

});
