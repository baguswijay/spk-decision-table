<?php

use App\Http\Controllers\BobotKriteriaController;
use App\Http\Controllers\PerhitunganController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::resource('/bobot', BobotKriteriaController::class);
// Route::resource('/hitung', \App\Http\Controllers\PerhitunganController::class);

Route::get('/hitung', [PerhitunganController::class, 'index'])->name('hitung.index');
Route::get('/hitung/create', [PerhitunganController::class, 'create'])->name('hitung.create');
Route::get('/hitung/edit/{id}', [PerhitunganController::class, 'edit'])->name('hitung.edit');
Route::get('/hitung/destroy/{id}', [PerhitunganController::class, 'destroy'])->name('hitung.destroy');
Route::post('/hitung/store', [PerhitunganController::class, 'store'])->name('hitung.store');
Route::post('/hitung/update/{id}', [PerhitunganController::class, 'update'])->name('hitung.update');



