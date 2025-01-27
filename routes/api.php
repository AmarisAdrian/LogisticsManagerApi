<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
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
    // Rutas relacionadas a clientes
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClienteController::class, 'userList'])->name('api.v1.clientes.userList'); // Listar clientes
       /* Route::get('/{id}', [ClienteController::class, 'show'])->name('api.v1.clientes.show'); // Obtener cliente por ID
        Route::post('/', [ClienteController::class, 'store'])->name('api.v1.clientes.store'); // Crear cliente
        Route::put('/{id}', [ClienteController::class, 'update'])->name('api.v1.clientes.update'); // Actualizar cliente
        Route::delete('/{id}', [ClienteController::class, 'destroy'])->name('api.v1.clientes.destroy'); // Eliminar cliente*/
    });
});
