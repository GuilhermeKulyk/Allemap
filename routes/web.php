<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Auth::routes();

/* 
| ---------------------------------------------------------------------------------
|   INGREDIENT CATEGORY
| ---------------------------------------------------------------------------------
*/
Route::prefix('ingredient-category')->group(function () {
    Route::get('/', [App\Http\Controllers\IngredientCategoryController::class, 'index'])
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
})->middleware('auth');
Route::post('ingredient-category/search', [App\Http\Controllers\IngredientCategoryController::class, 'search'])
->name('ingredient-category.search')->middleware('auth');;

/* 
| ---------------------------------------------------------------------------------
|   INGREDIENT
| ---------------------------------------------------------------------------------
*/
Route::resource('ingredient', 'App\Http\Controllers\IngredientController');
//->middleware('web');
Route::post('ingredient/search', [App\Http\Controllers\IngredientController::class, 'search'])
    ->name('ingredient.search')->middleware('auth');;

/*
| ---------------------------------------------------------------------------------
|   FOOD CATEGORY
| ---------------------------------------------------------------------------------
*/
Route::resource('food-category', 'App\Http\Controllers\FoodCategoryController')
    ->middleware('auth');
Route::post('food-category/search', [App\Http\Controllers\FoodCategoryController::class, 'search'])
    ->name('food-category.search')->middleware('auth');;

/*
|--------------------------------------------------------------------------
| FOOD
|--------------------------------------------------------------------------
*/
Route::resource('food', 'App\Http\Controllers\FoodController')
->middleware('auth');
Route::post('food/search', [App\Http\Controllers\FoodController::class, 'search'])
    ->name('food.search')->middleware('auth');

/*
|--------------------------------------------------------------------------
| MEAL
|--------------------------------------------------------------------------
*/
Route::resource('meal', 'App\Http\Controllers\MealController')
->middleware('auth');
Route::post('meal/search', [App\Http\Controllers\MealController::class, 'search'])
    ->name('meal.search')->middleware('auth');
