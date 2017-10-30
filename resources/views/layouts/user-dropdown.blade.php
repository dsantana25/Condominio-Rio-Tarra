  <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="text-dark material-icons d-user-icon text-dark">person</i>
  </a>

  {{-- Dropdown --}}
  {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    Logout
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>
</div> --}}
<div class="dropdown-menu dropdown-menu-right text-dark p-0" aria-label="navbarDropdownMenuLink" style="width:300px">

  <a class="dropdown-item bg-light mb-3" href="#" style="padding-top: 8px;
    padding-bottom: 8px;
    padding-left: 10px !important;
    padding-right: 10px !important;">
    <div class="row justify-content-center">
      <div class="col-3">
        <i class="text-dark material-icons d-user-icon d-user-dropdown">person</i>
      </div>
      <div class="col text-dark pt-3" style="line-height:0">
        <p><strong>{{ Auth::user()->name }}</strong></p>
        <small class="mt-3">{{ Auth::user()->email }}</small>
      </div>
    </div>
  </a>
  <a class="dropdown-item" href="#">
    <i class="material-icons align-middle mr-5">help</i>
    <p class="d-inline">Ayuda</p>
  </a>
  <a class="dropdown-item mb-3" href="#">
    <i class="material-icons align-middle mr-5">close</i>
    <p class="d-inline">Cerrar sesión</p>
  </a>

</div>
