<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

</head>
<body>
  <div id="app">

    <nav class="navbar navbar-expand-lg navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item mr-3">
          <a class="nav-link" href="#" id="menu-toggle"><i class="material-icons align-middle">menu</i></a>
        </li>
      </ul>
      <a class="navbar-brand brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <ul class="navbar-nav ml-auto">
          @if (Auth::guest())
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</span></a>
            </li>
          @else
            <a href="#" class="nav-item dropdown">
              @include('layouts.user-dropdown')
            </a>
          @endif
        </ul>
    </nav>


    <div class="d-flex flex-row">
      @if (!Auth::guest())
        <div id="wrapper" class="hidden"></div>
        {{-- Sidebar --}}
        <div class="d-flex flex-column sidebar hidden" id="sidebar">
          {{-- Cabecera --}}
          <div class="sidebar-header">
            <ul class="list-inline mb-1" style="padding: 0.5rem 1rem;">
              <li class="list-inline-item mr-0">
                <a href="#" id="menu-sidebar-toggle"><i class="material-icons sidebar-icon">menu</i></a>
              </li>
            </ul>
            <p class="sidebar-header-title">Condominio Edificio Río Tarra</p>
          </div>
          {{-- Opciones --}}
          <div class="list-group bg-light pt-3" id="sidebar-options">
            <a href="#" class="list-group-item">
              <i class="material-icons sidebar-icon">home</i>Inicio
            </a>
            <a class="list-group-item"href="{{route('apartamento.index')}}">
              <i class="material-icons sidebar-icon">business</i>Apartamentos
            </a>
            <a class="list-group-item" href="{{route('familia.index')}}">
              <i class="material-icons sidebar-icon">group</i>Familias
            </a>
            <a class="list-group-item" href="#">
              <i class="material-icons sidebar-icon">chrome_reader_mode</i>Alquileres
            </a>
            <a class="list-group-item" href="{{route('condominio.index')}}">
              <i class="material-icons sidebar-icon">attach_money</i>Contabilidad
            </a>
            <a class="list-group-item" href="{{route('condominio.settings')}}">
              <i class="material-icons sidebar-icon">settings</i>Configuración
            </a>
          </div>
        </div>
      @endif
      <div class="d-flex flex-column mt-4" style="width:100%" id="content">
        @yield('content')
        </div>
      </div>
    </div>

  </div>{{-- App --}}

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript">
  $("#menu-toggle,#menu-sidebar-toggle,#wrapper").click(function(e) {
      e.preventDefault();
      $("#sidebar,#wrapper").toggleClass("hidden");
      $('body').toggleClass('locked');
});
  </script>
</body>
</html>
