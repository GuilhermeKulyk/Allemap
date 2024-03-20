<div class="container">
    <div class="row">
        <div class="col">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row font-weight-bold">
                        <div class="col">{{__('messages.words.name')}}</div>
                        <div class="col">{{__('messages.words.categ')}}</div>
                        <div class="col-2 text-right">{{__('messages.words.name')}}</div>
                    </div>
                </li>
                @if (!empty($meals))
                    <!-- Linhas da lista -->
                    @foreach ($meals as $meal)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">{{ $meal->title }}</div>

                                <!-- Colunas de edição e exclusão -->
                                <div class="col-2 text-right">
                                    <!-- Link de edição -->
                                    <a href="{{ route('meal.edit', ['meal' => $meal->id ]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                    <!-- Formulário para exclusão -->
                                    <form id="form_{{ $meal->id }}" method="post" action="{{ route('meal.destroy', ['meal' => $meal->id ]) }}">
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
