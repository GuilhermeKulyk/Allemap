<div class="row aba">
    <div class="col mx-auto">
        
        <form action="{{$route}}" method='post'>
            @csrf
            <div class="input-group">
                @if (isset($search))
                    <input name="search" class="form-control border-end-0 border rounded-pill" value="{{ $search }}" type="search" placeholder="{{__("messages.words.search")}}" id="form-search-input">
                @else
                    <input name="search" class="form-control border-end-0 border rounded-pill" value="{{ old('search') }}" type="search" placeholder="{{__("messages.words.search")}}" id="form-search-input">
                @endif
                <span class="input-group-append">
                    <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>