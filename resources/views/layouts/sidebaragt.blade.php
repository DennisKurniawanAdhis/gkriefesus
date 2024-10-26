<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('keanggotaan') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin Anggota</div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li> --}}
    
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('products') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Product</span></a>
    </li> --}}

    <li class="nav-item">
      <a class="nav-link" href="{{ route('anggota') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Anggota</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('jenisIbadah') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Jenis Ibadah</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('keahlian') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Keahlian</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('pendeta') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Pendeta</span></a>



    {{-- pendeta start --}}

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pendeta</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{ route('pendeta') }}">Data Pendeta</a>
              <a class="collapse-item" href="{{ route('pendeta.dashboard') }}">Dashboard Pendeta</a>
          </div>
      </div>
  </li> --}}

    {{-- pendeta end --}}

    <li class="nav-item">
      <a class="nav-link" href="{{ route('pernikahan') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Pernikahan</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('calonBaptis') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Calon Baptis</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('ibadah') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Ibadah</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('komisi') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Komisi</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('DashboardPendeta.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard Pendeta</span></a>
    </li>
{{-- 
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard Pendeta</span></a>
    </li> --}}

    {{-- <li class="nav-item">
      <a class="nav-link" href="/profile">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Profile</span></a>
    </li> --}}

    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        <span>Logout</span></a>
    </li>

    {{-- <a class="dropdown-item text-white" href="{{ route('logout') }}">
      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
      Logout
    </a> --}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
    
  </ul>