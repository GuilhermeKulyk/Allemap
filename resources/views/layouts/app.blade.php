<!doctype html>
<html lang="pr-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
    <body>
        <div id="app">
            <!-- check if user is auth to show appropriate menu -->
            @auth
            <!-- main nav se nao estiver logado.-->
            @if(!Auth::check())
            @component('layouts._components.menu.main')
            @endcomponent
            @endif
            <!-- side nav -->
            <!-- nav lateral aqui -->
            <div class="container-{{ Route::currentRouteName() }}">
                <div id="container" class="container-fluid">
                    <div class="row d-flex flex-wrap">
                        
                    @component('layouts._components.menu.side')
                    @endcomponent
                        
                        <div class='col no-pad'>
            @endauth
                <!-- Main content -->
                <!-- if is login page, full size -->
                                
                                <main id="content" class="content-{{ str_replace(".", "-", Route::current()->getName()) }}">
                                @yield('content')
                                </main>
                            </div>        
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://kit.fontawesome.com/990eb888cd.js" crossorigin="anonymous"></script> 
    </body>
</html>
