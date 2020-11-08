<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/funcionarios', [FuncionarioController::class, 'index'] )->name('funcionarios.index');
Route::post('/funcionarios', [FuncionarioController::class, 'store'] )->name('funcionarios.store');
Route::get('/funcionarios/{id}', [FuncionarioController::class, 'show'] )->name('funcionarios.show');
Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy'] )->name('funcionarios.destroy');
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update'] )->name('funcionarios.update');