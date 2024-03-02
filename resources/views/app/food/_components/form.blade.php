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
                    <form id='form-{{ str_replace(".", "-", Route::current()->getName()) }}' 
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
                          <!-- Restante do formulário -->
                        <div class="form-input mb-3">   
                            <label class="form-label">{{ __('messages.words.name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $food->name ?? old('name') }}" >
                            {{ $errors->has('name') ? $errors->first('name') : '' }}
                        </div>
                        <div class="form-input mb-3">
                            <div class='row'>
                                <div class='col'>
                                    <label class="form-label">{{ __('messages.category') }}</label><br>
                                    <div class="input-group">
                                        <select name="category_id" class="form-select">
                                            @foreach($foodCategories as $foodCategory)
                                                <option value="{{ $foodCategory->id }}" {{ $food->category_id == $foodCategory->id ? 'selected' : '' }}>
                                                    {{ $foodCategory->category_name }}
                                                </option>
                                            @endforeach
                                        </select>                                        
                                        <button type="button" class="btn btn-outline-secondary" id="addCategoryButton" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+</button>
                                    </div>
                                    {{ $errors->has('category_id') ? $errors->first('category_id') : '' }}
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-input mb-3">   
                            <button type="submit" class="btn btn-primary form-control">{{ __('messages.words.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
