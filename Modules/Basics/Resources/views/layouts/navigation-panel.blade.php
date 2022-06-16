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
        <a class="nav-link" href="{{ route('dashboard.basics') }}">
          <i class="fa fa-home menu-icon"></i>
          <span class="menu-title">Dashboard Basico</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-estructura-basica" aria-expanded="false" aria-controls="page-estructura-basica">
          <i class="fab fa-trello menu-icon"></i>
          <span class="menu-title">Estructura Basica</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-estructura-basica">
          <ul class="nav flex-column sub-menu">
            @can('destination read')
              <li class="nav-item"><a class="nav-link" href="{{ route('basic.destinations') }}">Centros de Costos</a></li>
            @endcan
            @can('employee read')
              <li class="nav-item"> <a class="nav-link" href="{{ route('basic.employees') }}">Empleados</a></li>
            @endcan
            @can('client read')
              <li class="nav-item"> <a class="nav-link" href="{{ route('basic.clients') }}">Terceros</a></li>
            @endcan            
          </ul>
        </div>
      </li>      
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-creditos" aria-expanded="false" aria-controls="page-creditos">
          <i class="fas fa-puzzle-piece menu-icon"></i>
          <span class="menu-title">Creditos</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-creditos">
          <ul class="nav flex-column sub-menu">
            @can('destination read')
              <li class="nav-item"><a class="nav-link" href="{{ route('basic.payment') }}">Condicón de Pago</a></li>
            @endcan
            @can('employee read')
              <li class="nav-item"> <a class="nav-link" href="{{ route('basic.destinations') }}">......</a></li>
            @endcan
            @can('client read')
              <li class="nav-item"> <a class="nav-link" href="#">......</a></li>
            @endcan            
          </ul>
        </div>
      </li>
    </ul>
  </nav>