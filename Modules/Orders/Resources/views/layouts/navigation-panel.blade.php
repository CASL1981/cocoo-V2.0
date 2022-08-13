<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <div class="nav-link">
          <div class="profile-image">
            <img src="{{ asset(Auth()->user()->image_user) }}" alt="image"/>
          </div>
          <div class="profile-name">
            <p class="name">{{ Auth()->user()->firstname }}</p>
            <p class="designation">
              {{ Auth()->user()->roles()->first()->name ?? 'N/A' }}
            </p>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.orders') }}">
          <i class="fa fa-home menu-icon"></i>
          <span class="menu-title">Dashboard Ordenes Compra</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-estructura-basica" aria-expanded="false" aria-controls="page-layouts">
          <i class="fab fa-trello menu-icon"></i>
          <span class="menu-title">Estructura Basica</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-estructura-basica">
          <ul class="nav flex-column sub-menu">
            @can('product read')
              <li class="nav-item"><a class="nav-link" href="{{ route('order.products') }}">Productos</a></li>
            @endcan            
            @can('client read')
              <li class="nav-item"> <a class="nav-link" href="{{ route('order.prices') }}">Precio Productos</a></li>
            @endcan            
          </ul>
        </div>
      </li>      
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-creditos" aria-expanded="false" aria-controls="page-layouts">
          <i class="far fa-handshake menu-icon"></i>
          <span class="menu-title">Ordenes</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-creditos">
          <ul class="nav flex-column sub-menu">
            @can('operation read')
              <li class="nav-item"><a class="nav-link" href="{{ route('order.operation') }}">Orden de Compra</a></li>
              {{-- <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.basics') }}">Orden de Compra</a></li> --}}
            @endcan
            @can('services read')
              <li class="nav-item"> <a class="nav-link" href="#">Orden de Servicio</a></li>
            @endcan
            {{-- @can('client read')
              <li class="nav-item"> <a class="nav-link" href="#">......</a></li>
            @endcan --}}
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-parametros" aria-expanded="false" aria-controls="page-layouts">
          <i class="fas fa-cog menu-icon"></i>
          <span class="menu-title">Parametros</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-parametros">
          <ul class="nav flex-column sub-menu">
            @can('destination read')
              <li class="nav-item"><a class="nav-link" href="#">......</a></li>
            @endcan            
            @can('client read')
              <li class="nav-item"> <a class="nav-link" href="#">......</a></li>
            @endcan            
          </ul>
        </div>
      </li>
    </ul>
  </nav>