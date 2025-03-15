<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/upload', [MovieController::class, 'uploadJson'])->name('upload');
Route::get('/Nyt-NewsUpdates', [NewsController::class, 'getNytTopNewsUpdates'])->name('nyt-NewsUpdates');
Route::get('/movies', [MovieController::class, 'getAllMovies'])->name('movies-list');
Route::get('/movie/{id}', [MovieController::class, 'getMovie'])->name('get-movie');
Route::post('/register',[RegisterController::class, 'registerUser'])->name('register');
Route::post('/login', [RegisterController::class, 'login'])->name('login');

