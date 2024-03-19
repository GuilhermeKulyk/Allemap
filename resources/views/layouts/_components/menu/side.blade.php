

<div id='sidemenu' class="d-flex flex-column flex-shrink-0 p-3">
  <div class='logo-side-menu-container'>
    <div class='logo-side-menu'>  
      <img src="{{ asset('img/task/task.png') }}">
    </div>
  </div>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item {{ (request()->is('home') && !request()->is('food') && !request()->is('food-category') && !request()->is('ingredient') && !request()->is('ingredient-category') && !request()->is('config')) ? 'active' : '' }}">
      <a href="{{ route('home') }}" class="nav-link nav-link-side" aria-current="page">
        {{__('messages.sidemenu.home')}}
      </a>
    </li>
    <li class="nav-item {{ request()->is('meal') ? 'active' : '' }}">
      <a href="{{ route('meal.index') }}" class="nav-link nav-link-side">
        {{__('messages.sidemenu.meal')}}
      </a>
    </li>
    <li class="nav-item {{ request()->is('food') || request()->is('food-category') ? 'subitem-active' : '' }}">
      <a href="{{ route('food.index') }}" class="nav-link nav-link-side {{ request()->is('food') || request()->is('food-category') ? 'active' : '' }}">
        {{__('messages.sidemenu.food')}}
      </a>
      <ul class="submenu {{ request()->is('food') || request()->is('food-category') ? 'active' : '' }}">
        @if(request()->is('food') || request()->is('food-category'))
          <li style="list-style-type: none;"> <!-- Removendo o marcador de lista padrão -->
            <a href="{{ route('food-category.index') }}" class="nav-link nav-link-side {{ request()->is('food-category') ? 'active' : '' }}">
              <i class="fa-solid fa-arrow-up"></i> <!-- Ícone Font Awesome para representar o submenu -->
              {{__('messages.sidemenu.food-category')}}
            </a>
          </li>
        @endif
      </ul>
    </li>
    <li class="nav-item {{ request()->is('ingredient') || request()->is('ingredient-category') ? 'subitem-active' : '' }}">
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('ingredient') || request()->is('ingredient-category') ? 'active' : '' }}">
        {{__('messages.sidemenu.ingredient')}} 
      </a>
      <ul class="submenu {{ request()->is('ingredient-category') ? 'active' : '' }}">
        @if(request()->is('ingredient') || request()->is('ingredient-category'))
          <li style="list-style-type: none;"> <!-- Removendo o marcador de lista padrão -->
            <a href="{{ route('ingredient-category.index') }}" class="nav-link nav-link-side {{ request()->is('ingredient-category') ? 'active' : '' }}">
              <i class="fa-solid fa-arrow-up"></i> <!-- Ícone Font Awesome para representar o submenu -->
              {{__('messages.sidemenu.ingredient-category')}}  
            </a>
          </li>
        @endif
      </ul>
    </li>
    <li class="nav-item {{ request()->is('config') ? 'active' : '' }}">
      <a href="{{ route('home') }}" class="nav-link nav-link-side">
        {{__('messages.sidemenu.config')}} 
      </a>
    </li>
  </ul>
</div>
