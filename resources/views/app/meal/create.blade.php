@extends('layouts.app')

@section('content')

<x-navbar :menuName="'meal'" :menuItems="[
    __('messages.words.list') => 'meal.index',
    __('messages.words.create') => 'meal.create',
]" />

    @component('app.meal._components.form', [
        'user' => $user,
        'meal' => $meal
    ])
    @endcomponent
    
@endsection
