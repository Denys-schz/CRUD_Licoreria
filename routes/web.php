<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenCompraController;

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

Route::resource('/ordenCompra',OrdenCompraController::class,[
    'names'=>[
        'index'=>'ordenCompra.index',
        'store'=>'ordenCompra.store',
    ],
]);

Route::get('ordenCompra/busquedaByProveedor', [OrdenCompraController::class,'buscarProductos'])->name('ordenCompra.busquedaByProveedor');

Route::get('ordenCompra/EliminarProductoOrden', [OrdenCompraController::class,'eliminarProductoOrden'])->name('ordenCompra.eliminarProductoOrden');

Route::post('ordenCompra/editarProd', [OrdenCompraController::class,'editarProd'])->name('ordenCompra.editarProd');
