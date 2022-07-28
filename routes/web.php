<?php

use App\Http\Controllers\Api\APIFootballClubController;
use App\Http\Controllers\FootballClubController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
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



Route::middleware('auth')->group(function (){
//    Route::get('/clubs',[\App\Http\Controllers\FootballClubController::class, 'index'])->name('index');
    Route::get('/clubs/create',[FootballClubController::class, 'create'])->name('create');
    Route::post('/clubs',[FootballClubController::class, 'store'])->name('store');
    Route::get('/clubs/{clubId}',[FootballClubController::class, 'show'])->name('show');
    Route::get('/clubs/{club}/edit',[FootballClubController::class, 'edit'])->name('edit');
    Route::patch('/clubs/{club}',[FootballClubController::class, 'update'])->name('update');
    Route::delete('/clubs/{club}',[FootballClubController::class, 'destroy'])->name('destroy');
    Route::delete('/clubs/{club}/admin',[FootballClubController::class, 'destroyByAdmin'])->name('admin.destroy');
    Route::get('/clubs/{clubId}/restore',[FootballClubController::class, 'restore'])->name('restore');

    Route::get('/user/info',[UserController::class, 'giveInfo'])->name('user.info');
    Route::get('/user/{user:name}',[UserController::class, 'indexByUser'])->name('user.index');
    Route::get('/users',[UserController::class, 'index'])->name('users.index');
    Route::get('/user/{userId}/subscribe',[UserController::class, 'subscribe'])->name('user.subscribe');
    Route::get('/user/{userId}/unsubscribe',[UserController::class, 'unsubscribe'])->name('user.unsubscribe');
    Route::get('/user/{userId}/ribbon',[UserController::class, 'ribbon'])->name('user.ribbon');


    Route::get('/matches/{clubId}/create',[\App\Http\Controllers\MatchController::class, 'create'])->name('match.create');
    Route::post('/matches/{clubId}',[\App\Http\Controllers\MatchController::class, 'store'])->name('match.store');


    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');
});
require __DIR__.'/auth.php';
