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
        {{__('messages.sidemenu.meal')}}
      </a>
    </li>
    <li>
      <a href="{{ route('food.index') }}" class="nav-link nav-link-side {{ request()->is('foods') ? 'active' : '' }}">
        {{__('messages.sidemenu.food')}}
      </a>
    </li>
    <li>
      <a href="{{ route('food-category.index') }}" class="nav-link nav-link-side {{ request()->is('food-category') ? 'active' : '' }}">
        {{__('messages.sidemenu.food-category')}}
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('ingredient') ? 'active' : '' }}">
        {{__('messages.sidemenu.ingredient')}} 
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient-category.index') }}" class="nav-link nav-link-side {{ request()->is('ingredient-category') ? 'active' : '' }}">
        {{__('messages.sidemenu.ingredient-category')}}  
      </a>
    </li>
    <li>
      <a href="{{ route('ingredient.index') }}" class="nav-link nav-link-side {{ request()->is('config') ? 'active' : '' }}">
        {{__('messages.sidemenu.config')}} 
      </a>
    </li>
  </div> 

  
