
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                @if ($ingredientCategory->id) <!-- edit -->
                    <div class="card-header">{{ __("messages.words.edit") }} {{__('messages.ingredient_category')}} </div>
                @else <!-- Create -->
                    <div class="card-header">{{ __("messages.words.register") }} {{__('messages.ingredient_category')}} </div>
                @endif          
                <div class="card-body">
                    @if ($ingredientCategory->id) <!-- edit -->
                        <form id='form-{{ str_replace(".", "-", Route::current()->getName()) }}' action="{{ route('ingredient-category.update' , ['id' => $ingredientCategory->id] ) }}" method='post'>
                    @else <!-- Create -->
                         <form id='form-{{ str_replace(".", "-", Route::current()->getName()) }}' action="{{ route('ingredient-category.store') }}" method='post' >
                    @endif
                        @csrf
                        <div class="form-input mb-3">   
                            <label class="form-label">{{ __('messages.words.name') }}</label>
                            <input type="text" class="form-control" name="category_name" value="{{ $ingredientCategory->category_name ?? old('category_name') }}" >
                            {{ $errors->has('category_name') ? $errors->first('category_name') : '' }}
                        </div>
                        <div class="form-input mb-3">
                            <div class='row'>
                                <div class='col'>
                                    <div class="form-input mb-3" method='post'>   
                                        <label class="form-label">{{ __('messages.description') }}</label>
                                        <textarea class="form-control" name="description" rows="3">{{$ingredientCategory->description ?? old('description')}}</textarea>
                                        {{ $errors->has('description') ? $errors->first('description') : '' }}
                                    </div>
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