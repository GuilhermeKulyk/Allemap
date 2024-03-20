@extends('layouts.app')

@section('content')

<x-navbar :menuName="'foodes'" :menuItems="[
    __('messages.words.list') => 'meal.index',
    __('messages.words.create') => 'meal.create',
]" />

@component('app.meal._components.form', [
    'meal' => $meal, 
    'user' => $user
])
@endcomponent
@endsection