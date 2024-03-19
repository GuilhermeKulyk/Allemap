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
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form id="meal-form" action="{{ $meal->exists ? route('meal.update', ['meal' => $meal->id]) : route('meal.store') }}" method="POST">
                        @csrf
                        @if ($meal->exists)
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="title" class="form-label">{{ __('messages.words.title') }}</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ isset($meal->id) ? $meal->title : (old('title') ?? '') }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="notes" class="form-label">{{ __('messages.words.notes') }}</label>
                            <textarea class="form-control" id="notes" name="notes">{{ isset($meal->id) ? $meal->notes : (old('notes') ?? '') }}</textarea>
                            @error('notes')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="when" class="form-label">{{ __('messages.words.when') }}</label>
                            <input type="datetime-local" class="form-control" id="when" name="when" value="{{ isset($meal->id) ? ($meal->when ? date('Y-m-d\TH:i', strtotime($meal->when)) : '') : (old('when') ?? '') }}">
                            @error('when')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="rating" class="form-label">{{ __('messages.rating') }}</label>
                            <div class="rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ ($meal->rating ?? old('rating')) == $i ? 'checked' : '' }}>
                                    <label for="star{{ $i }}" title="{{ $i }} star"><i class="fas fa-star"></i></label>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMealModal">
                            {{ __('messages.add_meal') }}
                        </button>

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
<div class="modal fade" id="addTagsModal" tabindex="-1" aria-labelledby="addTagsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTagsModalLabel">{{ __('messages.add_tags') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Conteúdo do modal aqui -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                <button type="button" class="btn btn-primary">{{ __('messages.add') }}</button>
            </div>
        </div>
    </div>
</div>
