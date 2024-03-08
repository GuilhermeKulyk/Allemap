@extends('layouts.app')

@section('content')

<x-navbar :menuName="'foodes'" :menuItems="[
    __('messages.words.list') => 'food.index',
    __('messages.words.create') => 'food.create',
    __('messages.food_category') => 'food-category.index'
]" />

@component('app.food._components.form', [
    'food' => $food, 
    'foodCategory' => $foodCategory,
    'foodCategories' => $foodCategories,
    'userIngredients' => $userIngredients
    // obter lista de ingredientes da comida
])
@endcomponent
@endsection