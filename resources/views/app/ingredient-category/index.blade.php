
@extends('layouts.app')

@section('content')

@component('app.ingredient-category._components.topmenu')
@endcomponent

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 flex-grow-1">
            @component('layouts._components.search-bar')
            @endcomponent
            <a href="{{ route('ingredient-category.create') }}" class='btn small fw-light add-link'>Adicionar</a>
                @php 
                if (!isset($results)) 
                {
                    $results = [];

                }
                @endphp
                @component('layouts._components.list', [
                    'title' =>  __('messages.words.name'),
                    'data' => $results
                ])
                @endcomponent
            </div>
    </div>
</div>
@endsection

