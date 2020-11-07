<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
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
    try {
        \DB::connection()
            ->getPdo();
    } catch (Exception $e) {
        return 'Não foi possível se conectar ao banco de dados. Por favor verifique as configurações.';
    }
    return view('welcome');
});

Route::get('/funcionarios', [FuncionarioController::class, 'index'] );
Route::get('/funcionarios/{id}', [FuncionarioController::class, 'show'] );