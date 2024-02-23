@extends('layouts.app')

@section('content')
@component('app.ingredient._components.topmenu')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Registro de Ingrediente') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form id='form-{{ str_replace(".", "-", Route::current()->getName()) }}' action="{{ route('ingredient.create') }}" method='post' >
                        @csrf
                        <div class="form-input mb-3">   
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-input mb-3">
                            <div class='row'>
                                <div class='col'>
                                <label class="form-label">Nivel de toxidade</label>
                                    <select name="toxicity" class="form-select">
                                        <option selected>O</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="3">4</option>
                                    </select>
                                </div>
                                <div class='col'>
                                    <label class="form-label">Categoria</label><br>
                                    <select name="category_id" class="form-select">
                                        <option value="1" selected>Frutos do mar</option>
                                        <option value="2">Grãos</option>
                                        <option value="3">Frutas</option>
                                        <option value="4">Industrializados</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-input mb-3">   
                            <button type="submit" class="btn btn-primary form-control" class="category">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
