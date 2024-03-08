<nav class="navbar navbar-object">
    <div class="container-fluid">
      <div class='col'>
      <div class="dropdown">
        <button class="btn dropdown-toggle nav-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <b>foodes</b>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{route('food.index')}}">Lista</a>
          <a class="dropdown-item" href="{{route('food.create')}}">Cadastrar </a>
          <a class="dropdown-item" href="{{route('food-category.index')}}">Categorias</a>
        </div>
      </div>
      </div>
    </div>   
  </nav>
  
  