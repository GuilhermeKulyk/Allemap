@extends('layouts.app')

@section('content')

@component('app.ingredient-category._components.topmenu')
@endcomponent

@component('app.ingredient-category._components.form', ['ingredientCategory' => $ingredientCategory])
@endcomponent
@endsection
