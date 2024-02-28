<div id='sidemenu' class="d-flex flex-column flex-shrink-0 p-3">
  <div class='logo-side-menu-container'>
      <div class='logo-side-menu'>  
        <img src="{{ asset('img/task/task.png') }}">
      </div>
  </div>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="{{ route('home') }}" class="nav-link nav-link-side {{ request()->is('home') ? 'active' : '' }}" aria-current="page">
        Início
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('refeicao') ? 'active' : '' }}">
        Refeições
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('alimento') ? 'active' : '' }}">
        Alimentos
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('ingrediente') ? 'active' : '' }}">
        Ingredientes
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('configuracoes') ? 'active' : '' }}">
        Configurações
      </a>
    </li>
    <!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>
  </ul>
</div>