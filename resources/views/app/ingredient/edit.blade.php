@extends('layouts.app')

@section('content')

<x-navbar :menuName="'Ingredientes'" :menuItems="[
    __('messages.words.list') => 'ingredient.index',
    __('messages.words.create') => 'ingredient.create',
    __('messages.ingredient_category') => 'ingredient-category.index'
]" />

@component('app.ingredient._components.form', [
    'ingredient' => $ingredient, 
    'ingredientCategory' => $ingredientCategory,
    'ingredientCategories' => $ingredientCategories
])
@endcomponent
@endsection