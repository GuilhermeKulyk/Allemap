<div class="container">
    <div class="row">
        <div class="col">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row font-weight-bold">
                        <div class="col">{{__('messages.words.name')}}</div>
                        <div class="col">Categoria</div>
                        <div class="col-2 text-right">Ações</div>
                    </div>
                </li>
                @if (!empty($foods))
                    <!-- Linhas da lista -->
                    @foreach ($foods as $food)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">{{ $food->name }}</div>
                                <div class="col">
                                    @if($food->foodCategory())
                                        {{ $food->foodCategory->category_name }}
                                    @endif
                                </div>
                                <!-- Colunas de edição e exclusão -->
                                <div class="col-2 text-right">
                                    <!-- Link de edição -->
                                    <a href="{{ route('food.edit', ['food' => $food->id ]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                    <!-- Formulário para exclusão -->
                                    <form id="form_{{ $food->id }}" method="post" action="{{ route('food.destroy', ['food' => $food->id ]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Excluir</button>
                                    </form>                                    
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="list-group-item">
                        <h5>{{ __("messages.no_results") }}</h5>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
