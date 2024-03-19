@extends('layouts.app')

@section('content')

<x-navbar :menuName="'meales'" :menuItems="[
    __('messages.words.list') => 'meal.index',
    __('messages.words.create') => 'meal.create',
    __('messages.meal_category') => 'meal-category.index'
]" />

    @component('app.meal._components.form', [
        'meal' => $meal, 
        'user' => $user,
        // obter lista de ingredientes da comida, se caso existir
    ])
    @endcomponent
    
@endsection
