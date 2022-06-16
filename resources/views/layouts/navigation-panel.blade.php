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
      <a class="nav-link" href="/dashboard">
        <i class="fa fa-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>      
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
        <i class="fab fa-trello menu-icon"></i>
        <span class="menu-title">Configuración</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="page-layouts">
        <ul class="nav flex-column sub-menu">
          @can('usuario read') 
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.users') }}">Usuarios</a></li>              
          @endcan
          @can('role read')
            <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.roles') }}">Roles</a></li>              
          @endcan
          {{-- <li class="nav-item"> <a class="nav-link" href="#">Horizontal Menu</a></li> --}}
        </ul>
      </div>
    </li>      
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#page-modules" aria-expanded="false" aria-controls="page-layouts">
        <i class="fa fa-cubes menu-icon"></i>
        <span class="menu-title">Modulos</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="page-modules">
        <ul class="nav flex-column sub-menu">          
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.basics') }}">Basicos</a></li>
          
          {{-- @can('role read')
            <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.roles') }}">Roles</a></li>              
          @endcan --}}
          {{-- <li class="nav-item"> <a class="nav-link" href="#">Horizontal Menu</a></li> --}}
        </ul>
      </div>
    </li>      
  </ul>
</nav>