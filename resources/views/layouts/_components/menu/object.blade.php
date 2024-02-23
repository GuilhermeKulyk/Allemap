
@php

// geting route names by url
//$route = str_replace('-','.', request()->segment(1));
//$routeName = str_replace('-',' ', request()->segment(1));

@endphp
<nav class="navbar navbar-object">
  <div class="container-fluid">
    <div class='col'>
    <div class="dropdown">
      <button class="btn dropdown-toggle nav-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ ucfirst(request()->segment(1)) }}
      </button>
      @if ($route !== 'home')
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{route($route . ".create")}}">Cadastrar</a>
        <a class="dropdown-item" href="{{route($route . ".index")}}">Gerenciar Categorias</a>
      </div>
        @endif
    </div>
   
    @if (ucfirst(request()->segment(2) !== null))  
    <div class="dropdown">
      <button class="btn dropdown-toggle nav-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ ucfirst(request()->segment(2))   }}
      </button>

    </div>
    @endif
    </div>
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Buscar">
      <button class="btn btn-outline-success" type="submit">Pesquisar</button>
    </form>
  </div>

  
</nav>

