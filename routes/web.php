<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Home');
})->name('home');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/movies', [MoviesController::class, 'index'])->name('dashboard.movies');
    Route::get('/movies/add', [MoviesController::class, 'create']);
    Route::post('/movies/add', [MoviesController::class, 'store']);
    Route::get('/movies/edit/{id}', [MoviesController::class, 'edit']);
    Route::post('/movies/edit/{id}', [MoviesController::class, 'update']);
});

require __DIR__ . '/auth.php';
