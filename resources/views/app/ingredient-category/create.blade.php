@extends('layouts.app')

@section('content')

@component('app.ingredient-category._components.topmenu')
@endcomponent

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Registrar > Ingrediente > Categoria') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form id='form-{{ str_replace(".", "-", Route::current()->getName()) }}' action="{{ route('ingredient-category.store')  }}" method='post' >
                        @csrf
                        <div class="form-input mb-3">   
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="category_name">
                        </div>
                        <div class="form-input mb-3">
                            <div class='row'>
                                <div class='col'>
                                    <div class="form-input mb-3">   
                                        <label class="form-label">Descrição</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                                    </div>
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
