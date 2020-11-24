<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">

        @yield('css')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <div class="d-flex" id="content-wrapper" > 
            <!-- Sidebar -->
            <div id="sidebar-container" class="col-2 sidebar-container  d-none d-sm-none  d-md-none  d-lg-block">

                <div class="col bg-muted flex-column logo d-none d-xl-block mt-2">
                    <img src="{{ asset('') }}" alt="">
                </div>

                <div class="align-selft-center mt-3 option">
                    <!-- onclick="showNone(this.id)" -->
                    <a href="{{ route('sale.index') }}"  id="btn-home" class="item d-md-block text-light p-3 border-0 lign-selft-center"><i class="fas fa-home"></i> 
                            Home</a>
                </div>            

                <div class="align-selft-center mt-3 option">
                    <a href="{{ route('sale.create') }}" id="btn-ventas" class="item d-md-block text-light p-3 border-0 lign-selft-center"><i class="fas fa-shopping-bag"></i>  
                            Venta</a>
                </div>
                @if(Auth::user()->hasRole('admin'))
                    <div class="align-selft-center mt-3 option">
                        <a href="{{ route('user.index') }}"  id="btn-registro" class="item d-md-block text-light p-3 border-0 lign-selft-center"><i class="fas fa-users-cog"></i>  
                                Registrar Usuarios</a>
                    </div>
                @endif       

            </div>


            <div class="w-100">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom d-flex">
                    <!-- .container nos permite centrar el contenido de nuestro menu, esta clase es opcional y podemos encerrar el menu <nav> o incluir el contenedor dentro del <nav> -->
                    <div class="container">                    
                        <!-- Nos permite usar el componente collapse para dispositivos moviles -->
                        <button class="navbar-toggler align-self-sm-start order-1 order-sm-1" type="button" 
                            data-toggle="collapse" 
                            data-target="#navbar" 
                            aria-controls="navbar" 
                            aria-expanded="false" 
                            aria-label="Menu de Navegacion">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                            <div class="collapse navbar-collapse" id="navbar">
                            
                                <div class="align-selft-center mt-3 option">
                                    <a href="{{ route('sale.index')  }}" id="btn-home" class="item text-dark d-block  d-lg-none p-3 border-0 lign-selft-center"><i class="fas fa-home"></i> 
                                            Home</a>
                                </div>            
                    
                                <div class="align-selft-center mt-3 option">
                                    <a href="{{ route('sale.create') }}" id="btn-venta" class="item  text-dark p-3 d-block  d-lg-none border-0 lign-selft-center"><i class="fas fa-shopping-bag"></i>  
                                            Venta</a>
                                </div>
                                @if(Auth::user()->hasRole('admin'))
                                    <div class="align-selft-center mt-3 option">
                                        <a href="{{ route('user.index') }}" id="btn-registro" class="item  text-dark d-block  d-lg-none p-3 border-0 lign-selft-center"><i class="fas fa-users-cog"></i>  
                                                Registrar Usuarios</a>
                                    </div>                
                                @endif       

                            </div>


                        <ul class="navbar-nav mr-auto align-self-sm-center order-3 order-sm-2">
                            <div class="lign-selft-center mx-5 mt-2 d-block d-lg-none d-md-block">
                                <img src="{{ asset('') }}" id="logo" alt="">
                            </div>
                        </ul>
                        
                        <ul class="navbar-nav ml-auto align-self-md-baseline order-2 order-sm-3">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar Sesión') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
           

                <main id="content" class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
    
    @yield('scripts')

</body>
</html>
