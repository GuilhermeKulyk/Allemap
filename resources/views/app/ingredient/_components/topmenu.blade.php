<nav class="navbar navbar-object">
    <div class="container-fluid">
      <div class='col'>
      <div class="dropdown">
        <button class="btn dropdown-toggle nav-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <b>Ingredientes</b>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{route('ingredient.index')}}">Lista</a>
          <a class="dropdown-item" href="{{route('ingredient.create')}}">Cadastrar </a>
          <a class="dropdown-item" href="{{route('ingredient-category.index')}}">Categorias</a>
        </div>
      </div>
      </div>
    </div>   
  </nav>
  
  