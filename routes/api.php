<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {

    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClienteController::class, 'userList'])->name('api.v1.clientes.userList');
        Route::post('/crear-cliente', [ClienteController::class, 'addCreate'])->name('api.v1.clientes.addCreate');
        Route::get('/tipo-cliente', [ClienteController::class, 'getListTipoCliente'])->name('api.v1.utils.getListTipoCliente'); 
        Route::get('/{id}', [ClienteController::class, 'getClienteById'])->name('api.v1.clientes.getClienteById');
        Route::put('/editar-cliente/{id}', [ClienteController::class, 'update'])->name('api.v1.clientes.update');
    });
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductoController::class, 'productoList'])->name('api.v1.producto.productoList');
        Route::post('/crear-producto', [ProductoController::class, 'addCreate'])->name('api.v1.producto.addCreate');
        Route::get('/tipo-producto', [ProductoController::class, 'getListTipoProducto'])->name('api.v1.producto.getListTipoProducto'); 
        Route::put('/editar-producto/{id}', [ProductoController::class, 'update'])->name('api.v1.producto.update');
        //rutas dinamicas
        Route::get('/{id}', [ProductoController::class, 'getProductoById'])->name('api.v1.producto.getProductoById');
        Route::get('/buscar-producto/{nombre}', [ProductoController::class, 'getProductoByNombre'])->name('api.v1.producto.getProductoByNombre');
    });
});
