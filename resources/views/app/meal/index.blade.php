
@extends('layouts.app')

@section('content')

<x-navbar :menuName="'foodes'" :menuItems="[
    __('messages.words.list') => 'meal.index',
    __('messages.words.create') => 'meal.create',
]" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 flex-grow-1">
            <h1 class="display-5 text-center bold">{{ __('messages.meal') }}</h1>

            @if (!isset($search))
                @php
                $search = '';
                @endphp
            @endif
            
            @component('layouts._components.search-bar', ['search' => $search, 'route' => 'meal.search'])
            @endcomponent

            <a href="{{ route('meal.create') }}" class='btn small fw-light add-link text-center'>{{__("messages.words.add")}}</a>
            
            @php
            if (!isset($meals)) 
            {
                $meals = [];
            }
            @endphp
            @component('app.meal._components.list', [
                'title' =>  __('messages.words.title'),
                'meals' => $meals,
            ])
            @endcomponent
        </div>
    </div>
</div>
@endsection

