<!-- x-navbar.blade.php -->
<nav class="navbar navbar-object">
    <div class="container-fluid">
        <div class='col'>
            <div class="dropdown">
                <button class="btn dropdown-toggle nav-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <b>{{ $menuName }}</b>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($menuItems as $name => $route)
                        <a class="dropdown-item" href="{{ route($route) }}">{{ $name }}</a> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>   
</nav>




