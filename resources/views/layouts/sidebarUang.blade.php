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
    <li class="nav-item {{ Request::is('perpuluhan') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('perpuluhan') }}">
        <i class="fa-solid fa-money-check-dollar"></i>
        <span>Perpuluhan</span></a>
    </li>
    
    <li class="nav-item {{ Request::is('kolekte') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('kolekte') }}">
        <i class="fa-solid fa-money-check-dollar"></i>
        <span>Kolekte</span></a>
    </li>

    <li class="nav-item {{ Request::is('sumbangan') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('sumbangan') }}">
        <i class="fa-solid fa-money-check-dollar"></i>
        <span>Sumbangan</span></a>
    </li>

    <li class="nav-item {{ Request::is('pengeluaran') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pengeluaran') }}">
        <i class="fa-solid fa-money-check-dollar"></i>
        <span>Pengeluaran</span></a>
    </li>

    <li class="nav-item {{ Request::is('DashboardKas') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('DashboardKas.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard Kas</span></a>
    </li>

    @if ( auth()->user()->role == 'super' )
    <li class="nav-item">
      <a class="nav-link" href="{{ route('super') }}">
        <i class="fa-solid fa-user"></i>
        <span>Halaman Super Admin</span></a>
    </li>
    @endif
  
    <li class="nav-item">
      <a class="nav-link" href="#" onclick="confirmLogout(event)">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          <span>Logout</span>
      </a>
  </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
    
  </ul>

<script>
  function confirmLogout(event) {
      event.preventDefault(); // Mencegah link default
      const confirmation = confirm("Apakah Anda yakin ingin logout?");
      if (confirmation) {
          // Jika pengguna mengkonfirmasi, arahkan ke route logout
          window.location.href = "{{ route('logout') }}";
      }
  }
  </script>