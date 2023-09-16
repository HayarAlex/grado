<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav" >
    <li class="nav-item nav-profile">
      <div class="nav-link d-flex">
        <div class="profile-image">
          <img style="border-radius: 3px" src="../../images/faces/default.png" alt="image">
        </div>
        <div class="profile-name">
          <p class="name">
            {{ Auth::user()->name }}
          </p>
          @if (Auth::user()->rol_id == 1)
              <p class="designation">
                Super Admin
              </p>
          @endif
          @if (Auth::user()->rol_id == 2)
              <p class="designation">
                Administrador
              </p>
          @endif
          @if (Auth::user()->rol_id == 3)
              <p class="designation">
                Encargado
              </p>
          @endif
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/home') }}">
      <i class="mdi mdi-home menu-icon"></i>
      <span class="menu-title">Home</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('product.index') }}">
      <i class="mdi mdi-book menu-icon"></i>
      <span class="menu-title">Productos</span>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('sale.index') }}">
      <i class="mdi mdi-tag-multiple menu-icon"></i>
      <span class="menu-title">Ventas</span>
      </a>
    </li> --}}
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#venta" aria-expanded="false" aria-controls="venta">
      <i class="mdi mdi-tag-multiple menu-icon"></i>
      <span class="menu-title">Ventas</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="venta">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="#">Nueva venta</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('sale.index') }}">Historial de ventas</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
      <i class="mdi mdi-pen menu-icon"></i>
      <span class="menu-title">Gestion de productos</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="editors">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('category.index') }}">Categorias</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('sport.index') }}">Deportes</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('productType.index') }}">Tipo producto</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#training" aria-expanded="false" aria-controls="training">
      <i class="mdi mdi-pen menu-icon"></i>
      <span class="menu-title">Gestion de Entrenamientos</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="training">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="#">Entrenamientos</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('team.index') }}">Equipos</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#gest-user" aria-expanded="false" aria-controls="gest-user">
      <i class="mdi mdi-account-circle menu-icon"></i>
      <span class="menu-title">Gestion de usuarios</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="gest-user">
        <ul class="nav flex-column sub-menu">
          @if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
          <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">Administradores</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('responsible.index') }}">Encargados</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('coach.index') }}">Entrenadores</a></li>
          @endif
          <li class="nav-item"><a class="nav-link" href="{{ route('customer.index') }}">Clientes</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('space.index') }}">
      <i class="mdi mdi-book menu-icon"></i>
      <span class="menu-title">Gestion de Espacios deprtivos</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('reservation.index') }}">
      <i class="mdi mdi-book menu-icon"></i>
      <span class="menu-title">Reservas</span>
      </a>
    </li>
  </ul>
</nav>