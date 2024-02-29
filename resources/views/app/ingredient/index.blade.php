
@extends('layouts.app')

@section('content')

<x-navbar :menuName="'Ingredientes'" :menuItems="[
    __('messages.words.list') => 'ingredient.index',
    __('messages.words.create') => 'ingredient.create',
    __('messages.ingredient_category') => 'ingredient-category.index'
]" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 flex-grow-1">

            @if (!isset($search))
                @php
                $search = '';
                @endphp
            @endif
            
            @component('layouts._components.search-bar', ['search' => $search, 'route' => 'search'])
            @endcomponent

            <a href="{{ route('ingredient.create') }}" class='btn small fw-light add-link'>{{__("messages.words.add")}}</a>
            
                @php
                if (!isset($results)) 
                {
                    $results = [];
                }
                @endphp

                @component('app.ingredient._components.list', [
                    'title' =>  __('messages.words.name'),
                    'results' => $results
                ])
                @endcomponent
        </div>
    </div>
</div>
@endsection

