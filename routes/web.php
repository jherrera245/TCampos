<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteComprasController;
use App\Http\Controllers\ReporteVentasController;
use App\Http\Requests\ReporteComprasFormRequest;
use App\Http\Requests\ReporteVentasFormRequest;

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

//agregando rutas de controladores
Route::resource('/categorias', CategoriasController::class);
Route::resource('/marcas', MarcasController::class);
Route::resource('/productos', ProductosController::class);
Route::resource('/proveedores', ProveedoresController::class);
Route::resource('/ingresos', IngresosController::class);
Route::resource('/clientes', ClientesController::class);
Route::resource('/ventas', VentasController::class);
Route::resource('/reportes-compras', ReporteComprasController::class);
Route::resource('/reportes-ventas', ReporteVentasController::class);
Auth::routes();

//rutas para graficas
Route::get('/datos-grafica/ventas-clientes', function(){
    return HomeController::dataVentaPorCliente();
});

//rutas para graficas
Route::get('/datos-grafica/productos-categorias', function(){
    return HomeController::dataProductoPorCategoria();
});

//rutas para Reportes
Route::post('/pdf-compras', function(ReporteComprasFormRequest $request){
    return ReporteComprasController::reporteCompras($request);
});

//rutas para Reportes
Route::post('/pdf-ventas', function(ReporteVentasFormRequest $request){
    return ReporteVentasController::reporteVentas($request);
});


Route::get('/home', [HomeController::class, 'index'])->name('home');