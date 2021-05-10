<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use Carbon\Carbon;
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

//Forma de acceder a todos los métodos creados para el CRUD
Route::resource('usuario', UsuariosController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [UsuariosController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [UsuariosController::class, 'index'])->name('home');
    
});