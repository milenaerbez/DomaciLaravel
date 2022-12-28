<?php

use App\Http\Resources\GenreResource;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\API\AuthController;
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

Route::get('/users', [UserController::class, 'index']); //za prikaz svih korisnika
Route::resource('genres', GenreController::class); //za prikaz zanrova
Route::redirect('/korisnici', '/users');
Route::redirect('/zanrovi', '/genres');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get(
        '/profile',
        function (Request $request) {
            return auth()->user();
        }
    );
    Route::resource('movies', MovieController::class)->only(['update', 'store', 'destroy']);
    Route::delete('/deletemovie/{id}', [MovieController::class, 'destroy']);

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});