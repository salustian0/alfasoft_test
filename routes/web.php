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

Route::get('/', [\App\Http\Controllers\ContactController::class, 'index'])->name('index');
Route::get('/new', [\App\Http\Controllers\ContactController::class, 'create']);
Route::post('/store', [\App\Http\Controllers\ContactController::class, 'store'])->name('store');

//Não foi possível utilizar o metodo delete
Route::get('/destroy/{id}', [\App\Http\Controllers\ContactController::class, 'destroy'])->name('delete_contact');

Route::get('/edit/{id}', [\App\Http\Controllers\ContactController::class, 'edit'])->name('edit_contact');
Route::get('/update/{id}', [\App\Http\Controllers\ContactController::class, 'update'])->name('update_contact');
