
@extends('layouts.app')
@section('content')
@component('app.ingredient-category._components.topmenu')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 flex-grow-1">
            @if (!isset($search))
                @php
                $search = '';
                @endphp
            @endif
            @component('layouts._components.search-bar', ['search' => $search, 'route' => 'ingredient-category.search'])
            @endcomponent
            <a href="{{ route('ingredient-category.create') }}" class='btn small fw-light add-link'>{{__("messages.words.add")}}</a>
            @php 
            if (!isset($results)) 
            {
                $results = [];
            }
            @endphp
            @component('app.ingredient-category._components.list', [
                'title' =>  __('messages.words.name'),
                'data' => $results
            ])
            @endcomponent
        </div>
    </div>
</div>
@endsection

