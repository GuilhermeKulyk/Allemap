<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::resource('ingrediente', 'App\Http\Controllers\IngredientController')
->middleware('auth');

Route::resource('alimento', 'App\Http\Controllers\FoodController')
->middleware('auth');

Route::resource('refeicao', 'App\Http\Controllers\RefeicaoController')
->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
