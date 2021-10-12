<?php
use App\Models\Categoria;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoriaController,
    CurtidaController, 
    PlaylistController,
    EpisodioController,
    ContaController
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
})->name('home');

Route::group(['middleware' => ['auth']], function () { 
    //Route::get('/categoria', [CategoriaController::class, 'index'])->name('index_categoria');
    Route::get('/categoria/{id}', [CategoriaController::class, 'categoria'])->name('categoria');
    Route::get('/show/{id}', [CategoriaController::class, 'show'])->name('show');

    
    Route::get('/conta', [ContaController::class, 'index'])->name('conta');
    Route::post('/canal', [ContaController::class, 'canal'])->name('canal');
   
    Route::get('/curtida', [CurtidaController::class, 'index'])->name('curtida');
    Route::post('/curtida', [CurtidaController::class, 'curtida']);

    Route::get('/add_ep' , [EpisodioController::class, 'index'])->name('add_ep');
    Route::post('/episodio', [EpisodioController::class, 'episodio'])->name('episodio');
    Route::post('/delete_ep', [EpisodioController::class, 'delete_ep']);
    Route::post('/edit_titulo', [EpisodioController::class, 'trocar_titulo'])->name('edit_titulo');
    

    Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist');
    Route::post('/add_playlist', [PlaylistController::class, 'add_playlist']);
    Route::post('/delete_playlist', [PlaylistController::class, 'delete_playlist'])->name('delete_playlist');
    Route::get('/show_playlist/{id}', [PlaylistController::class, 'show_playlist'])->name('show_playlist');
    Route::post('/renome_playlist', [PlaylistController::class, 'renome_playlist'])->name('renome_playlist');
    Route::post('/remove_ep_playlist', [PlaylistController::class, 'remove_ep']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $categorias = Categoria::get();

    return view('categoria.index', compact('categorias'));
})->name('dashboard');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
