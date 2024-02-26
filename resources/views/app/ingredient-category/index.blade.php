
@extends('layouts.app')

@section('content')

@component('app.ingredient-category._components.topmenu')
@endcomponent

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 flex-grow-1">
            @component('layouts._components.search-bar')
            @endcomponent
                @php 
                if (!isset($results)) 
                {
                    $results = [];
                }
                @endphp
                
                @component('layouts._components.list', [
                    'title' =>  __('messages.name'),
                    'data' => $results
                ])

                @endcomponent
            </div>
    </div>
</div>
@endsection

