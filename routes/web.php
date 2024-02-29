<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    Route::get('/index', [App\Http\Controllers\IngredientCategoryController::class, 'index'])
    ->name('ingredient-category.index');

    Route::get('/create', [App\Http\Controllers\IngredientCategoryController::class, 'create'])
    ->name('ingredient-category.create');

    Route::post('/store', [App\Http\Controllers\IngredientCategoryController::class, 'store'])
    ->name('ingredient-category.store');

    Route::get('/{ingredientCategory}/edit', [App\Http\Controllers\IngredientCategoryController::class, 'edit'])
    ->name('ingredient-category.edit');

    Route::post('/{id}/update', [App\Http\Controllers\IngredientCategoryController::class, 'update'])
    ->name('ingredient-category.update');

    Route::delete('/{ingredientCategory}/delete', [App\Http\Controllers\IngredientCategoryController::class, 'destroy'])
    ->name('ingredient-category.delete');

    Route::post('/search', [App\Http\Controllers\IngredientCategoryController::class, 'search'])
    ->name('ingredient-category.search');

}); //->middleware('auth');

Route::resource('ingredient', 'App\Http\Controllers\IngredientController')
->middleware('auth');

Route::resource('food', 'App\Http\Controllers\FoodController')
->middleware('auth');

Route::resource('meal', 'App\Http\Controllers\MealController')
->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
