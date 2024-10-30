<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('super') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Super Admin</div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin') }}">
          <i class="fa-solid fa-user"></i>
          <span>Admin</span>
      </a>
  </li>

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