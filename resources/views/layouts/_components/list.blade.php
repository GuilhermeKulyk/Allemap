<div class="container">
    <div class="row">
        <div class="col">
            <ul class="list-group">
                @if (!empty($data))
                    <!-- Cabeçalho da tabela -->
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col bold">{{ $title }}</div>
                            <!-- Adicionando espaço em branco para as colunas de edição e exclusão -->
                            <div class="col-2"></div>
                        </div>
                    </li>
                    <!-- Linhas da tabela -->
                    @foreach ($data as $category)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">{{ $category->category_name }}</div>
                                <!-- Colunas de edição e exclusão -->
                                <div class="col-1 text-right">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                </div>
                                <div class="col-1 text-right">
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <h5>{{ __("messages.category_no_results") }}</h5>
                @endif
            </ul>
        </div>
    </div>
</div>
