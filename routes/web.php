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



Route::middleware('auth')->group(function (){
//    Route::get('/clubs',[\App\Http\Controllers\FootballClubController::class, 'index'])->name('index');
    Route::get('/clubs/create',[\App\Http\Controllers\FootballClubController::class, 'create'])->name('create');
    Route::post('/clubs',[\App\Http\Controllers\FootballClubController::class, 'store'])->name('store');
    Route::get('/clubs/{clubId}',[\App\Http\Controllers\FootballClubController::class, 'show'])->name('show');
    Route::get('/clubs/{club}/edit',[\App\Http\Controllers\FootballClubController::class, 'edit'])->name('edit');
    Route::patch('/clubs/{club}',[\App\Http\Controllers\FootballClubController::class, 'update'])->name('update');
    Route::delete('/clubs/{club}',[\App\Http\Controllers\FootballClubController::class, 'destroy'])->name('destroy');
    Route::delete('/clubs/{club}/admin',[\App\Http\Controllers\FootballClubController::class, 'destroyByAdmin'])->name('admin.destroy');
    Route::get('/clubs/{clubId}/restore',[\App\Http\Controllers\FootballClubController::class, 'restore'])->name('restore');

    Route::get('/users/{user:name}',[\App\Http\Controllers\UserController::class, 'indexByUser'])->name('user.index');
    Route::get('/users',[\App\Http\Controllers\UserController::class, 'index'])->name('users.index');


    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');
});
require __DIR__.'/auth.php';
