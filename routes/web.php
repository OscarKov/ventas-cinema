<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\PurchaseController;
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

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/movies', [MoviesController::class, 'index'])->name('dashboard.movies');
    Route::get('/movies/add', [MoviesController::class, 'create']);
    Route::post('/movies/add', [MoviesController::class, 'store']);
    Route::get('/movies/edit/{id}', [MoviesController::class, 'edit']);
    Route::post('/movies/edit/{id}', [MoviesController::class, 'update']);
    Route::delete('/movies/delete', [MoviesController::class, 'destroy'])
        ->name('movie.delete');

    Route::get('/movies/{id}/shows', [MoviesController::class, 'getMovieShows'])
        ->name('movie.shows');
    Route::get('/show/add', [MoviesController::class, 'getAddShow'])
        ->name('shows.add');
    Route::post('/show/add', [MoviesController::class, 'postAddShow']);
    Route::get('/show/edit/{id}', [MoviesController::class, 'getEditShow'])
        ->name('shows.edit');
    Route::post('/show/edit/{id}', [MoviesController::class, 'postEditShow']);
});

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::get('/listing/{movie_id}', [ListingController::class, 'getMovieListing'])
    ->name('movieListing');

Route::post('/purchase', [PurchaseController::class, 'purchase'])
    ->name('purchase')
    ->middleware('auth');

require __DIR__ . '/auth.php';
