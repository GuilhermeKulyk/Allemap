<nav class="navbar navbar-object">
    <div class="container-fluid">
      <div class='col'>
      <div class="dropdown">
        <button class="btn dropdown-toggle nav-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{__("messages.foods" )}} > <b>{{__("messages.food_categories")}}</b>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{route('food-category.index')}}">{{__("words.list")}} {{strtolower(__("food_categories"))}}</a>
          <a class="dropdown-item" href="{{route('food-category.create')}}">{{__("words.register")}} {{strtolower(__("food_categories"))}}</a>
          <a class="dropdown-item" href="{{route('food.index')}}">{{url()->previous()}}</a>
        </div>
      </div>
      </div>
    </div>   
  </nav>
  
  