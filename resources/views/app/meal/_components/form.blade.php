@php
$errors = session('errors'); 
session()->forget('errors');
@endphp
@if($errors)
<div class="alert alert-danger" role="alert">
    @foreach($errors as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                @if ($meal->exists) <!-- Edit -->
                    <div class="card-header">{{ __("messages.words.edit") }} {{ __("messages.meal") }}</div>
                @else <!-- Create -->
                    <div class="card-header">{{ __("messages.words.register") }} {{ __("messages.meal") }}</div>
                @endif
                <div class="card-body">
                    <form id="meal-form" action="{{ $meal->exists ? route('meal.update', ['meal' => $meal->id]) : route('meal.store') }}" method="POST">
                        @csrf
                        @if ($meal->exists)
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="title" class="form-label">{{ __('messages.words.title') }}</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ isset($meal->id) ? $meal->title : (old('title') ?? '') }}">
                        </div>


                        <!-- Seção para listar alimentos -->
                        <label for="mainFoodList" class="form-label">{{ __('messages.foods') }}</label><br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFoodModal">
                            <i class="fas fa-plus"></i> {{ __('messages.edit_foods') }}
                        </button>
                        <!-- No seu formulário principal -->    
                        <ul id="mainFoodList" class="list-group mt-2">   
                            @if (!empty($meal->foods()))                         
                                @foreach ($meal->foods as $food)
                                    <li class="list-group-item" data-id="{{ $food->id }}">{{ $food->name }}</li>
                                @endforeach
                            </ul>
                            @else
                            <div class="alert alert-warning mt-3" role="alert">
                                {{ __('messages.no_foods') }}
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </ul>
                        @endif

                        <div class="form-group mb-3 mt-3">
                            <label for="notes" class="form-label">{{ __('messages.words.notes') }}</label>
                            <textarea class="form-control" id="notes" name="notes">{{ isset($meal->id) ? $meal->notes : (old('notes') ?? '') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="when" class="form-label">{{ __('messages.words.when') }}</label>
                            <input type="datetime-local" class="form-control" id="when" name="when" value="{{ isset($meal->id) ? ($meal->when ? date('Y-m-d\TH:i', strtotime($meal->when)) : '') : (old('when') ?? '') }}">
                        </div>
                        
                        <div class="d-flex justify-content-between mt-2">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">{{ __('messages.words.cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('messages.words.register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para adicionar tags -->
<div class="modal fade" id="addFoodModal" tabindex="-1" aria-labelledby="addFoodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal-food-add">{{ __('messages.register.food') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('messages.close')}}"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 d-flex align-items-center">
                    <input type="text" class="form-control" id="foodSearch" placeholder="{{ __('messages.words.search')}}">
                    <button class="btn btn-primary ms-2" id="searchButton"><i class="fas fa-search"></i></button>
                </div>
                <ul id="includedFood" class="list-group mb-3">
                    <!-- food incluídos aparecerão aqui -->  
                </ul>
                <ul id="foodList" class="list-group">
                    @foreach ($user->foods as $food)
                        <li class="list-group-item" data-id="{{ $food->id }}">{{ $food->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                <button type="button" class="btn btn-primary">{{ __('messages.add') }}</button>
            </div>
        </div>
    </div>
</div>
