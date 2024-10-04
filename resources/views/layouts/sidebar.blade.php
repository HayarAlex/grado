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
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
      <i class="mdi mdi-pen menu-icon"></i>
      <span class="menu-title">Gestion de productos</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="editors">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('category.index') }}">Categorias</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('sport.index') }}">Unidades de Negocio</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('almacen.index') }}">Almacenes</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#distribution" aria-expanded="false" aria-controls="distribution">
      <i class="mdi mdi-cart-plus menu-icon"></i>
      <span class="menu-title">Distribucion</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="distribution">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('distribucion.index') }}">Pedidos Sucursal</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('distribucion.indexadm') }}">Adm de Pedidos</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#insti" aria-expanded="false" aria-controls="insti">
      <i class="mdi mdi-file-document menu-icon"></i>
      <span class="menu-title">Licitaciones</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="insti">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('institucion.index') }}">Licitaciones</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('institucion.indexadm') }}">Adm de Licitaciones</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('institucion.indexapro') }}">Aprobacion de Licitaciones</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('config.index') }}">Asignacion</a></li>
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
          <li class="nav-item"><a class="nav-link" href="{{ route('responsible.index') }}">Vendedores</a></li>
          @endif
          <li class="nav-item"><a class="nav-link" href="{{ route('customer.index') }}">Clientes</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
      <i class="mdi mdi-worker menu-icon"></i>
      <span class="menu-title">Orden de Produccion</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="order">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('order.index') }}">Orden de produccion</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('productType.index') }}">Linea de produccion</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('promotion.index') }}">Tareas</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('team.index') }}">Actividades</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>