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
      <a href="{{ route('refeicao.index') }}" class="nav-link nav-link-side {{ request()->is('refeicao') ? 'active' : '' }}">
        Refeições
      </a>
    </li>
    <li>
      <a href="{{ route('alimento.index') }}" class="nav-link nav-link-side {{ request()->is('alimento') ? 'active' : '' }}">
        Alimentos
      </a>
    </li>
    <li>
      <a href="{{ route('ingrediente.index') }}" class="nav-link nav-link-side {{ request()->is('ingrediente') ? 'active' : '' }}">
        Ingredientes
      </a>
    </li>
    <li>
      <a href="{{ route('ingrediente.index') }}" class="nav-link nav-link-side {{ request()->is('configuracoes') ? 'active' : '' }}">
        Configurações
      </a>
    </li>
  </ul>
</div>
