@extends('layouts.app')

@section('content')

@component('app.food-category._components.topmenu')
@endcomponent

@component('app.food-category._components.form', ['foodCategory' => $foodCategory])
@endcomponent
@endsection
