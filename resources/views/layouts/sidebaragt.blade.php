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

    <li class="nav-item {{ Request::is('anggota') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('anggota') }}">
        <i class="fa-solid fa-user"></i>
        <span>Anggota</span></a>
    </li>

    <li class="nav-item {{ Request::is('jenisIbadah') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('jenisIbadah') }}">
        <i class="fa-solid fa-list"></i>
        <span>Jenis Ibadah</span></a>
    </li>

    <li class="nav-item {{ Request::is('keahlian') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('keahlian') }}">
        <i class="fa-solid fa-guitar"></i>
        <span>Keahlian</span></a>
    </li>

    <li class="nav-item {{ Request::is('pendeta') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pendeta') }}">
        <i class="fa-solid fa-user-tie"></i>
        <span>Pendeta</span></a>


    {{-- pendeta end --}}

    <li class="nav-item {{ Request::is('pernikahan') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pernikahan') }}">
        <i class="fa-solid fa-children"></i>
        <span>Pernikahan</span></a>
    </li>

    <li class="nav-item {{ Request::is('calonBaptis') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('calonBaptis') }}">
        <i class="fa-solid fa-cross"></i>
        <span>Calon Baptis</span></a>
    </li>

    <li class="nav-item {{ Request::is('ibadah') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('ibadah') }}">
        <i class="fa-solid fa-church"></i>
        <span>Ibadah</span></a>
    </li>

    <li class="nav-item {{ Request::is('komisi') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('komisi') }}">
        <i class="fa-solid fa-network-wired"></i>
        <span>Komisi</span></a>
    </li>

    <li class="nav-item {{ Request::is('DashboardPendeta') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('DashboardPendeta.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard Pendeta</span></a>
    </li>



    <li class="nav-item">
      <a class="nav-link" href="#" onclick="confirmLogout(event)">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          <span>Logout</span>
      </a>
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