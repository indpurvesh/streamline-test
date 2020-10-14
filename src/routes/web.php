<?php

use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')
    ->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
        Route::resource('directory', DirectoryController::class);
        Route::post('directory/{directory}/file', [FileController::class, 'upload']);
        Route::get('directory/{directory}/file', [FileController::class, 'index']);
    });
