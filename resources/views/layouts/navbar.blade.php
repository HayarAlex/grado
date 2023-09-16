<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-left navbar-brand-wrapper d-flex align-items-center justify-content-between">
      <a class="navbar-brand brand-logo" href="index-2.html"><img src="../../images/logo.svg" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="../../images/logo-mini.svg" alt="logo"/></a> 
      <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
      </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-search d-none d-lg-flex">
          <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" aria-expanded="false">
          <span class="nav-profile-name">Hola, {{ Auth::user()->name }} {{ Auth::user()->paternal }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <form  action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-link" style="text-decoration: none;color: #242635">Cerrar Sesión</button>
            </form>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
      </button>
    </div>
</nav>