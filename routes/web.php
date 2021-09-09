<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoriaController,
    PerfilController,
    CurtidaController, 
    PlaylistController
};

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
    return view('home');
});

Route::group(['middleware' => ['auth']], function () { 
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('index_categoria');
    Route::get('/categoria/{id}', [CategoriaController::class, 'categoria'])->name('categoria');
    Route::get('/show/{id}', [CategoriaController::class, 'show'])->name('show');

    
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/canal', [PerfilController::class, 'canal'])->name('canal');
    Route::post('/episodio', [PerfilController::class, 'episodio'])->name('episodio');


    Route::get('/curtida', [CurtidaController::class, 'index'])->name('curtida');


    Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
