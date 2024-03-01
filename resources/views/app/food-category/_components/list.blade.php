<div class="container">
    <div class="row">
        <div class="col">
            <ul class="list-group">
                @if (!empty($data))
                    @foreach ($data as $foodCategory)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">{{ $foodCategory->category_name }}</div>
                                <!-- Colunas de edição e exclusão -->
                                <div class="col-1 text-right">
                                    <a href="{{ route('food-category.edit', ['foodCategory' => $foodCategory->id ]) }}"><button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button></a>
                                </div>
                                <div class="col-1 text-right">
                                    
                                    <form id="form_{{$foodCategory->id}}" method="post" action="{{ route('food-category.delete', ['foodCategory' => $foodCategory->id ]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>-->
                                        <a href="#" onclick="document.getElementById('form_{{$foodCategory->id}}').submit()" class='btn btn-sm btn-primary'><i class="fa fa-trash"></i></a>
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
