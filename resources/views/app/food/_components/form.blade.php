<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                @if ($food->exists) <!-- Edit -->
                    <div class="card-header">{{ __("messages.words.edit") }} {{ __("messages.food") }}</div>
                @else <!-- Create -->
                    <div class="card-header">{{ __("messages.words.register") }} {{ __("messages.food") }}</div>
                @endif

                <div class="card-body">
                    <form id='form-create-food'  
                        @if ($food->exists)
                            action="{{ route('food.update', ['food' => $food->id]) }}"
                        @else 
                            action="{{ route('food.store') }}"
                        @endif
                        method='post'>
                        @csrf
                        @if ($food->exists)
                            @method('PUT')
                        @endif
                        <!-- Campo para adicionar ou editar o nome do alimento -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">{{ __('messages.words.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $food->name ?? old('name') }}">
                            <!-- Aqui você pode incluir mensagens de erro, se aplicável -->
                        </div>

                        <!-- Seção para selecionar a categoria do alimento -->
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">{{ __('messages.category') }}</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="" selected disabled>{{ __('messages.words.empty') }}</option>
                               
                                @foreach ($userFoodCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Seção para listar ingredientes -->
                        <label for="mainIngredientList" class="form-label">{{ __('messages.ingredients') }}</label><br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIngredientsModal">
                            <i class="fas fa-plus"></i> {{ __('messages.add_ingredients') }}
                        </button>
                            <!-- No seu formulário principal -->    
                            
                            <ul id="mainIngredientList" class="list-group mt-2">   
                                @if (!empty($food->ingredients()))                         
                                @foreach ($food->ingredients as $ingredient)
                                    <li class="list-group-item" data-id="{{ $ingredient->id }}">{{ $ingredient->name }}</li>
                                @endforeach
                            </ul>
                            @else
                            <div class="alert alert-warning mt-3" role="alert">
                                {{ __('messages.no_ingredients') }}
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </ul>
                        @endif

                        <!-- Botões -->
                        <div class="d-flex justify-content-between mt-2">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('messages.words.cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('messages.words.register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para adicionar ingredientes -->
<div class="modal fade" id="addIngredientsModal" tabindex="-1" aria-labelledby="addIngredientsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addIngredientsModalLabel">{{ __('messages.add_ingredients') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 d-flex align-items-center">
                    <input type="text" class="form-control" id="ingredientSearch" placeholder="{{ __('messages.words.search')}}">
                    <button class="btn btn-primary ms-2" id="searchButton"><i class="fas fa-search"></i></button>
                </div>
                <ul id="includedIngredients" class="list-group mb-3">
                    <!-- Ingredientes incluídos aparecerão aqui -->
                </ul>
                <ul id="ingredientList" class="list-group">
                    @foreach ($userIngredients as $ingredient)
                        <li class="list-group-item" data-id="{{ $ingredient->id }}">{{ $ingredient->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" href="{{ url()->previous() }}" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="saveIngredients">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
