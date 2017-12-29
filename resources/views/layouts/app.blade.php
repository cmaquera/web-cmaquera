<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Web de presentacion y ocio">
        <meta name="author" content="Cesar Maquera">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Styles -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Cutive+Mono" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/app.css', true)}}"/>
        <!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">-->
    </head>
    <body>
        <header>
          <!--<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#"><b>CM</b>aquera</a>
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/dashboardPanel">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/">Ver web</a>
                </li>
              </ul>
              <form class="form-inline mt-2 mt-md-0">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Salir</button>
              </form>
            </div>
          </nav>-->
          <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="{{ route('index') }}"><b>CM</b>aquera</a>
                <button class="navbar-toggler d-lg-none collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
                  @guest
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('index') }}">Inicio</a>
                          </li>
                          <li class="nav-item {{ Request::is('me') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('me') }}">Acerca de mi</a>
                          </li>
                          <li class="nav-item {{ Request::is('posts') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('posts') }}">Posts</a>
                          </li>
                          <li class="nav-item {{ Request::is('projects') ? 'active' : '' }}">
                            <a class="nav-link" href="/projects">Proyectos</a>
                          </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                  @else
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href="/panel">Panel</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/">Ver web</a>
                        </li>
                          
                      </ul>             
                      <form class="form-inline mt-2 mt-md-0" id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <label style="color: white;">{{ Auth::user()->name }}  </label>
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Salir</button>
                      </form>
                  @endguest
                  
                </div>
              </nav>
        </header>
        
        
        @if (Route::has('login'))
            
                @auth
                    <div class="container-fluid">
                      <div class="row">
                        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                          <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                              <div class="col-md-auto">
                      			    <img src="images/logo-cm.png" class="img-fluid" alt="cmaquera perfil image">
                      			  </div>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{ Request::is('dashboardPanel') ? 'active' : '' }}" href="/dashboardPanel"><i class="icon ion-android-desktop"></i> Panel</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{ Request::is('postsPanel') ? 'active' : '' }}" href="/postsPanel"><i class="icon ion-android-list"></i> Posts</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{ Request::is('projectsPanel') ? 'active' : '' }}" href="/projectsPanel"><i class="icon ion-android-folder"></i> Proyectos</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{ Request::is('subscribersPanel') ? 'active' : '' }}" href="/subscribersPanel"><i class="icon ion-android-contacts"></i> Suscriptores</a>
                            </li>
                          </ul>
                        </nav>
                        @yield('content')
                      </div>
                    </div>
                @else
                    @yield('content')
                @endauth
           
        @endif
        
        <!-- Scripts -->
        <script type="text/javascript" src="{{asset('js/app.js', true)}}"></script>
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
        
        @yield('script')
    </body>
</html>
