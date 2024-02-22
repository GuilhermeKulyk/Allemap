@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Registrar ingrediente') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form id='form-{{ str_replace(".", "-", Route::current()->getName()) }}' action="{{ route('task.store') }}" method='post' >
                        @csrf
                        <div class="form-input mb-3">   
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-input mb-3">   
                            <label class="form-label">Categoria</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-input mb-3">
                            <div class='row'>
                            <div class='col'>
                            <label class="form-label">Tipo</label>
                            <input type="datetime-local" class="form-control" name="due_date">
                            </div>
                            <div class='col'>
                            <label class="form-label">Nivel de alergia</label>
                            <input type="text" class="form-control" name="title">
                            < </div>
                            <div class='col'>
                                <label class="form-label">Tipo</label><br>
                                <select class="form-select">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                            </div>
                        </div>
                        </div>

                        <div class="form-input mb-3">   
                            <button type="submit" class="btn btn-primary form-control" class="category">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
