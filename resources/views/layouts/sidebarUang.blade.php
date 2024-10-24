<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('keuangan') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin Keuangan</div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('perpuluhan') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Perpuluhan</span></a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('kolekte') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Kolekte</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('sumbangan') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Sumbangan</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('pengeluaran') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Pengeluaran</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('DashboardKas.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard Kas</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        <span>Logout</span></a>
    </li>

    
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('products') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Product</span></a>
    </li> --}}
    
    {{-- <li class="nav-item">
      <a class="nav-link" href="/profile">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Profile</span></a>
    </li> --}}
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
    
  </ul>