<?php

use App\Http\Controllers\CallcenterController;
use App\Http\Controllers\LineasController;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('callcenters/pdf',[App\Http\Controllers\CallcenterController::class, 'pdf'])->name('callcenters.pdf');

Route::resource('/callcenters', CallcenterController::class)->middleware('auth');
Route::resource('/lineas', LineasController::class)->middleware('auth');;

Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

