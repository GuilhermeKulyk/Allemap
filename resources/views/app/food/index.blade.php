
@extends('layouts.app')

@section('content')

<x-navbar :menuName="'foodes'" :menuItems="[
    __('messages.words.list') => 'food.index',
    __('messages.words.create') => 'food.create',
    __('messages.food_category') => 'food-category.index'
]" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 flex-grow-1">
            <h1 class="display-5 text-center bold">Alimentos</h1>

            @if (!isset($search))
                @php
                $search = '';
                @endphp
            @endif
            
            @component('layouts._components.search-bar', ['search' => $search, 'route' => 'food.search'])
            @endcomponent

            <a href="{{ route('food.create') }}" class='btn small fw-light add-link text-center'>{{__("messages.words.add")}}</a>
            
            @php
            if (!isset($results)) 
            {
                $results = [];
            }
            @endphp
            @component('app.food._components.list', [
                'title' =>  __('messages.words.name'),
                'results' => $results,
                'foods' => $foods
            ])
            @endcomponent
        </div>
    </div>
</div>
@endsection

