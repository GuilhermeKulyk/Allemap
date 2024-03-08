<div class="container">
    <div class="row">
        <div class="col">
            <ul class="list-group">
                @if (!empty($data))
                    <!-- Cabeçalho da tabela -->

                   
                    <!-- Linhas da tabela -->
                    @foreach ($data as $ingredientCategory)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">{{ $ingredientCategory->category_name }}</div>
                                <!-- Colunas de edição e exclusão -->
                                <div class="col-1 text-right">
                                    <a href="{{ route('ingredient-category.edit', ['ingredientCategory' => $ingredientCategory->id ]) }}"><button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button></a>
                                </div>
                                <div class="col-1 text-right">
                                    
                                    <form id="form_{{$ingredientCategory->id}}" method="post" action="{{ route('ingredient-category.delete', ['ingredientCategory' => $ingredientCategory->id ]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>-->
                                        <a href="#" onclick="document.getElementById('form_{{$ingredientCategory->id}}').submit()" class='btn btn-sm btn-primary'><i class="fa fa-trash"></i></a>
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
