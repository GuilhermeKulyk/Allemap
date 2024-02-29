@extends('layouts.app')

@section('content')
    @component('app.ingredient._components.topmenu')
    @endcomponent

    @component('app.ingredient._components.form', [
        'ingredient' => $ingredient, 
        'ingredientCategories' => $ingredientCategories
    ])
    @endcomponent
@endsection
