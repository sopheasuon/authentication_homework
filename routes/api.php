<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// user
Route::post('/register', [UserController::class, "register"]);
Route::post('/login', [UserController::class, "login"]);
// post public
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'index']);
//Private
Route::group(['middleware'=> ['auth:sanctum']], function(){
    Route::post('/posts', [PostController::class, "store"]);
    Route::put('/posts/{id}', [PostController::class, "update"]);
    Route::delete('/posts/{id}', [PostController::class, "destroy"]);

    Route::post('/logout', [UserController::class, "logout"]);
});