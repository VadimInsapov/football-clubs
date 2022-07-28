<?php
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\APIFootballClubController;
use \App\Http\Controllers\Api\APIMatchController;
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
Route::prefix('/user')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
});
Route::middleware('auth:api')->group( function () {
    Route::resource('clubs', APIFootballClubController::class);
    Route::resource('matches', APIMatchController::class);
});
