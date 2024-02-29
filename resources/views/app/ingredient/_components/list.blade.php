<div class="container">
    <div class="row">
        <div class="col">
            <ul class="list-group">
                @if (!empty($data))
                    <!-- Linhas da lista -->
                    @foreach ($data as $ingredient)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">{{ $ingredient->name }}</div>
                                <div class="col">{{ $ingredient->ingredientCategory->categoryName }}</div>
                                <div class="col">{{ $ingredient->toxicity }}</div>
                                <!-- Colunas de edição e exclusão -->
                                <div class="col-1 text-right">
                                    <!-- Botão de edição -->
                                    <a href="{{ route('ingredient-category.edit', ['ingredientCategory' => $ingredient->id ]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="col-1 text-right">
                                    <!-- Formulário para exclusão -->
                                    <form id="form_{{ $ingredient->id }}" method="post" action="{{ route('ingredient-category.delete', ['ingredientCategory' => $ingredient->id ]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" onclick="document.getElementById('form_{{ $ingredient->id }}').submit()" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></a>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <h5>{{ __("messages.no_results") }}</h5>
                @endif
            </ul>
        </div>
    </div>
</div>
