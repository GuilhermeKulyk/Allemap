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

Route::prefix('ingredient-category')->group(function () {
    Route::get('/index', [App\Http\Controllers\IngredientCategoryController::class, 'index'])->name('ingredient-category.index');
    Route::get('/create', [App\Http\Controllers\IngredientCategoryController::class, 'create'])->name('ingredient-category.create');
    Route::post('/store', [App\Http\Controllers\IngredientCategoryController::class, 'store'])->name('ingredient-category.store');
    Route::get('/list', [App\Http\Controllers\IngredientCategoryController::class, 'list'])->name('ingredient-category.list');
});


Route::resource('ingredient', 'App\Http\Controllers\IngredientController')
->middleware('auth');

Route::resource('food', 'App\Http\Controllers\FoodController')
->middleware('auth');

Route::resource('meal', 'App\Http\Controllers\MealController')
->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
