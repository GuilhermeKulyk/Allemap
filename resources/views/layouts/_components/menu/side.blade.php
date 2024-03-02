<div id='sidemenu' class="d-flex flex-column flex-shrink-0 p-3">
  <div class='logo-side-menu-container'>
      <div class='logo-side-menu'>  
        <img src="{{ asset('img/task/task.png') }}">
      </div>
  </div>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="{{ route('home') }}" class="nav-link nav-link-side {{ request()->is('home') ? 'active' : '' }}" aria-current="page">
        {{__('messages.sidemenu.home')}}
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient-category.index') }}" class="nav-link nav-link-side {{ request()->is('meal') ? 'active' : '' }}">
        Refeições
      </a>
    </li>
    <li>
      <a href="{{ route('food.index') }}" class="nav-link nav-link-side {{ request()->is('foods') ? 'active' : '' }}">
        {{__('messages.foods')}}
      </a>
    </li>
    <li>
      <a href="{{ route('food-category.index') }}" class="nav-link nav-link-side {{ request()->is('food-category') ? 'active' : '' }}">
        {{__('messages.foods')}} - Categorias
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('ingredient') ? 'active' : '' }}">
        Ingredientes
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient-category.index') }}" class="nav-link nav-link-side {{ request()->is('ingredient-category') ? 'active' : '' }}">
        Ingredientes - Categorias
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('config') ? 'active' : '' }}">
        Configurações
      </a>
    </li>
    <!-- Example single danger button -->
  </div> 

  
