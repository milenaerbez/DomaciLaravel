<?php

use App\Http\Resources\GenreResource;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get(
        '/profile',
        function (Request $request) {
            return auth()->user();
        }
    );
    Route::resource('movies', MovieController::class)->only(['update', 'add', 'destroy']);
    Route::delete('/deletemovie/{id}', [MovieController::class, 'destroy']);
    Route::put('/update/{id}', [MovieController::class, 'updateById']);
    Route::post('/addmovie', [MovieController::class, 'add']);
    Route::get('/movieyear/{year}', [MovieController::class, 'thisyear']);
    Route::get('/genremovies/{id}', [MovieController::class, 'genremovies']);
    Route::get('/users', [UserController::class, 'index']); //za prikaz svih korisnika

    Route::redirect('/korisnici', '/users');


    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/allmovies', [MovieController::class, 'index']);