<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[\App\Http\Controllers\FootballClubController::class, 'index']);
Route::get('/clubs',[\App\Http\Controllers\FootballClubController::class, 'index']);
Route::get('/clubs/create',[\App\Http\Controllers\FootballClubController::class, 'create']);
Route::post('/clubs',[\App\Http\Controllers\FootballClubController::class, 'store']);
Route::get('/clubs/{club}',[\App\Http\Controllers\FootballClubController::class, 'show']);
Route::get('/clubs/{club}/edit',[\App\Http\Controllers\FootballClubController::class, 'edit']);
Route::patch('/clubs/{club}',[\App\Http\Controllers\FootballClubController::class, 'update']);
Route::delete('/clubs/{club}',[\App\Http\Controllers\FootballClubController::class, 'destroy']);
