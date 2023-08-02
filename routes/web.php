<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\NegocioController;
use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ReporteController;

use App\Http\Controllers\Negocio\LoginController;
use App\Http\Controllers\Negocio\BannerController;
use App\Http\Controllers\Negocio\CategoriaProductoController;
use App\Http\Controllers\Negocio\CuponController;
use App\Http\Controllers\Negocio\ProductoController;
use App\Http\Controllers\Negocio\PedidoNegocioController;

use App\Http\Controllers\Cliente\ClienteController;


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
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
          Route::view('/','admin.login')->name('login');
          Route::post('/check',[AdminController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){

        Route::get('/dashboard', [AdminController::class,'countItems'])->name('dashboard');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');
        Route::get('/editProfile/{id}',[AdminController::class,'editProfile'])->name('editProfile');
        Route::post('/updateProfile',[AdminController::class,'updateProfile'])->name('updateProfile');
        Route::post('/updatePassword',[AdminController::class,'updatePassword'])->name('updatePassword');

        //Usuario
        Route::get('/usuarios/list', [ClienteController::class,'list'])->name('usuario.index');

        //Categorias - rutas de la vista
        Route::get('/categorias/list', [CategoriaController::class,'list'])->name('categoria.index');
        Route::get('/categorias/add', [CategoriaController::class,'create'])->name('categoria.create');
        Route::get('/categorias/edit/{id}', [CategoriaController::class,'edit'])->name('categoria.edit');

        //Categorías - rutas del CRUD
        Route::post('/categorias/addcategoria', [CategoriaController::class,'add'])->name('categoria.add');
        Route::post('/categorias/updatecategoria', [CategoriaController::class, 'update'])->name('categoria.update');
        Route::get('/categorias/delete/{id}', [CategoriaController::class, 'delete'])->name('categoria.delete');


        //Negocios - rutas de la vista
        Route::get('/negocios/list', [NegocioController::class,'list'])->name('negocio.index');
        Route::get('/negocios/add', [NegocioController::class,'create'])->name('negocio.create');
        Route::get('/negocios/edit/{id}', [NegocioController::class,'edit'])->name('negocio.edit');

        //Negocios - rutas del CRUD
        Route::post('/negocios/addnegocio', [NegocioController::class,'add'])->name('negocio.add');
        Route::post('/negocios/updatenegocio', [NegocioController::class, 'update'])->name('negocio.update');
        Route::get('/negocios/delete/{id}', [NegocioController::class, 'delete'])->name('negocio.delete');


        //Pedidos
        Route::get('/pedidos/list', [PedidoController::class,'list'])->name('pedido.index');
        Route::get('mark_all_notifications', [PedidoController::class,'mark_all_notifications'])->name('pedido.allNotifications');
        Route::get('/pedidos/{id}', [PedidoController::class,'viewdetail'])->name('pedido.detail');
        Route::get('/notificacion/{id}', [PedidoController::class,'notification'])->name('pedido.notification');
        Route::get('mark_a_notifications/{notification_id}/{order_id}', [PedidoController::class,'mark_a_notifications'])->name('pedido.aNotifications');


        //Planes - rutas de las vista
        Route::get('/planes/list', [PlanController::class,'list'])->name('plan.index');
        Route::get('/planes/add', [PlanController::class,'create'])->name('plan.create');
        Route::get('/planes/edit/{id}', [PlanController::class,'edit'])->name('plan.edit');

        //Planes - rutas del CRUD
        Route::post('/planes/addPlan', [PlanController::class,'add'])->name('plan.add');
        Route::post('/planes/updateplan', [PlanController::class, 'update'])->name('plan.update');
        Route::get('/planes/delete/{id}', [PlanController::class, 'delete'])->name('plan.delete');


        //Reporte
        Route::get('/reportes', [ReporteController::class,'generateReport'])->name('generateReport');
        Route::post('/listReport', [ReporteController::class,'listReport'])->name('listReport');

    });
});


Route::prefix('/')->name('negocio.')->group(function(){

    Route::middleware(['guest:negocio','PreventBackHistory'])->group(function(){
          Route::view('/','welcome')->name('login');
          Route::post('/check',[LoginController::class,'check'])->name('check');
    });

    Route::middleware(['auth:negocio','PreventBackHistory'])->group(function(){

        //Usuario Negocio cerrar sesión - editar perfil
        Route::post('/logout',[LoginController::class,'logout'])->name('logout');
        Route::get('/editProfile/{id}',[LoginController::class,'editProfile'])->name('editProfile');
        Route::post('/updateProfile',[LoginController::class,'updateProfile'])->name('updateProfile');
        Route::post('/updatePassword',[LoginController::class,'updatePassword'])->name('updatePassword');

        Route::get('/dashboard', [LoginController::class,'countItems'])->name('dashboard');

        //Categorias de Productos - rutas de la vista
        Route::get('/categorias/list', [CategoriaProductoController::class,'list'])->name('categoria.index');
        Route::get('/categorias/create', [CategoriaProductoController::class,'create'])->name('categoria.create');
        Route::get('/categorias/edit/{id}', [CategoriaProductoController::class,'edit'])->name('categoria.edit');

        //Categorías de Productos - rutas del CRUD
        Route::post('/categorias/addcategoria', [CategoriaProductoController::class,'add'])->name('categoria.add');
        Route::post('/categorias/updatecategoria', [CategoriaProductoController::class, 'update'])->name('categoria.update');
        Route::get('/categorias/delete/{id}', [CategoriaProductoController::class, 'delete'])->name('categoria.delete');

        //Productos - rutas de las vista
        Route::get('/productos/list', [ProductoController::class,'list'])->name('producto.index');
        Route::get('/productos/create', [ProductoController::class,'create'])->name('producto.create');
        Route::get('/productos/edit/{id}', [ProductoController::class,'edit'])->name('producto.edit');

        //Productos - rutas del CRUD
        Route::post('/productos/addproducto', [ProductoController::class,'add'])->name('producto.add');
        Route::post('/productos/updateproducto', [ProductoController::class, 'update'])->name('producto.update');
        Route::get('/productos/delete/{id}', [ProductoController::class, 'delete'])->name('producto.delete');

        //Pedidos
        Route::get('/pedidos/list', [PedidoNegocioController::class,'list'])->name('pedido.index');
        Route::get('mark_all_notifications', [PedidoNegocioController::class,'mark_all_notifications'])->name('pedido.allNotifications');
        Route::get('/pedidos/{id}', [PedidoNegocioController::class,'viewdetail'])->name('pedido.detail');
        Route::get('mark_a_notifications/{notification_id}/{order_id}', [PedidoNegocioController::class,'mark_a_notifications'])->name('pedido.aNotifications');

        //Cupon - rutas de la vista
        Route::get('/cupones/list', [CuponController::class,'list'])->name('cupon.index');
        Route::get('/cupones/create', [CuponController::class,'create'])->name('cupon.create');
        Route::get('/cupones/edit/{id}', [CuponController::class,'edit'])->name('cupon.edit');

        //Cupon - rutas del CRUD
        Route::post('/cupones/addcupon', [CuponController::class,'add'])->name('cupon.add');
        Route::post('/cupones/updatecupon', [CuponController::class, 'update'])->name('cupon.update');
        Route::get('/cupones/delete/{id}', [CuponController::class, 'delete'])->name('cupon.delete');

        //Banners - rutas de la vista
        Route::get('/banners/list', [BannerController::class,'list'])->name('banner.index');
        Route::get('/banners/create', [BannerController::class,'create'])->name('banner.create');
        Route::get('/banners/edit/{id}', [BannerController::class,'edit'])->name('banner.edit');

        //Banners - rutas del CRUD
        Route::post('/banners/addbanner', [BannerController::class,'add'])->name('banner.add');
        Route::post('/banners/updatebanner', [BannerController::class, 'update'])->name('banner.update');
        Route::get('/banners/delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');

    });
});

