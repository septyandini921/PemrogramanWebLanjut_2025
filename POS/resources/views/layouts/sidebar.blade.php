<div class="sidebar" style="background-color: #001f3f;"> <!-- Navy background -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        @auth
            @if(Auth::user()->foto)
                <img src="{{ asset('storage/uploads/user/' . Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #5dade2;">
            @else
                <img src="{{ asset('adminlte/dist/img/default-user.png') }}" class="img-circle elevation-2" alt="User Image" style="border: 2px solid #5dade2;">
            @endif
        @endauth
    </div>
    <div class="info">
        <a href="{{ route('profile.edit') }}" class="d-block" style="color: #ffffff; font-weight: 500;">{{ Auth::user()->nama ?? 'User' }}</a>
    </div>
  </div>
  
  <!-- SidebarSearch Form --> 
  <div class="form-inline mt-2"> 
    <div class="input-group" data-widget="sidebar-search" style="background-color: #003366; border-radius: 20px;"> 
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" style="background-color: transparent; color: white; border: none;">
      <div class="input-group-append"> 
        <button class="btn btn-sidebar" style="background-color: transparent; color: #5dade2;"> 
          <i class="fas fa-search fa-fw"></i> 
        </button> 
      </div> 
    </div> 
  </div> 
  
  <!-- Sidebar Menu --> 
  <nav class="mt-2"> 
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
      <li class="nav-item"> 
        <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }}" style="color: #ffffff;">
          <i class="nav-icon fas fa-home" style="color: #5dade2;"></i> 
          <p>Dashboard</p> 
        </a> 
      </li> 
      <li class="nav-item"> 
        <a href="{{ route('profile.edit') }}" class="nav-link {{ ($activeMenu == 'profile')? 'active' : '' }}" style="color: #ffffff;">
          <i class="nav-icon fas fa-user-cog" style="color: #5dade2;"></i>
          <p>Edit Profil</p>
        </a>
      </li> 
      
      <li class="nav-header" style="color: #5dade2; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Data Pengguna</li> 
      <li class="nav-item"> 
        <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level')? 'active' : '' }}" style="color: #ffffff;"> 
          <i class="nav-icon fas fa-users-cog" style="color: #5dade2;"></i> 
          <p>Level User</p> 
        </a> 
      </li> 
      <li class="nav-item"> 
        <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user')? 'active' : '' }}" style="color: #ffffff;"> 
          <i class="nav-icon fas fa-user-friends" style="color: #5dade2;"></i> 
          <p>Data User</p> 
        </a> 
      </li> 
      
      <li class="nav-header" style="color: #5dade2; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Data Barang</li> 
      <li class="nav-item"> 
        <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori')? 'active' : '' }}" style="color: #ffffff;"> 
          <i class="nav-icon fas fa-tags" style="color: #5dade2;"></i> 
          <p>Kategori Barang</p> 
        </a> 
      </li> 
      <li class="nav-item">
        <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier')? 'active' : '' }}" style="color: #ffffff;">
          <i class="nav-icon fas fa-parachute-box" style="color: #5dade2;"></i>
          <p>Data Supplier</p>
        </a>
      </li>  
      <li class="nav-item"> 
        <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang')? 'active' : '' }}" style="color: #ffffff;"> 
          <i class="nav-icon fas fa-box-open" style="color: #5dade2;"></i> 
          <p>Data Barang</p> 
        </a> 
      </li> 
      
      <li class="nav-header" style="color: #5dade2; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Data Transaksi</li> 
      <li class="nav-item"> 
        <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok')? 'active' : '' }}" style="color: #ffffff;"> 
          <i class="nav-icon fas fa-warehouse" style="color: #5dade2;"></i> 
          <p>Stok Barang</p> 
        </a> 
      </li> 
      <li class="nav-item">
        <a href="{{ url('/transaksi') }}" class="nav-link {{ ($activeMenu == 'penjualan')? 'active' : '' }}" style="color: #ffffff;">
          <i class="nav-icon fas fa-receipt" style="color: #5dade2;"></i>
          <p>Transaksi Penjualan</p>
        </a>
      </li> 
      
      <li class="nav-item mt-3">
        <form id="logout-form-sidebar" action="{{ url('logout') }}" method="GET">
          @csrf
          <button type="submit" class="nav-link btn btn-danger text-left w-100" style="border-radius: 5px;">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </li>
    </ul> 
  </nav> 
</div>

<style>
  .sidebar {
    background-color: #001f3f;
    color: white;
  }
  
  .nav-link:hover {
    background-color: #003366 !important;
  }
  
  .nav-link.active {
    background-color: #0056b3 !important;
    border-left: 4px solid #5dade2;
  }
  
  .nav-item > .nav-link {
    margin-bottom: 5px;
    border-radius: 5px;
  }
  
  .sidebar .nav-header {
    padding: 10px 25px 10px 15px;
    margin-top: 10px;
  }
</style>