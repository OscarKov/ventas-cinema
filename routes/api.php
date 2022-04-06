<?php

use App\Http\Controllers\API\APIMoviesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/movies', [APIMoviesController::class, 'index']);
    Route::get('/movies/{id}', [APIMoviesController::class, 'show']);
    Route::post('/movies/add', [APIMoviesController::class, 'store']);
    Route::put('/movies/update', [APIMoviesController::class, 'update']);
    Route::delete('/movies/delete/{id}', [APIMoviesController::class, 'destroy']);

    Route::get('/movies/{id}/shows', [APIMoviesController::class, 'getMovieShows']);
    Route::post('/show/add', [APIMoviesController::class, 'postAddShow']);
    Route::put('/show/edit/{id}', [APIMoviesController::class, 'putEditShow']);
    Route::delete('/show/delete/{id}', [APIMoviesController::class, 'deleteShow']);
});
