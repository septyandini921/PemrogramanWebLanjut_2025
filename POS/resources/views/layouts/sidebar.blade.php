<div class="sidebar"> 
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        @auth
            @if(Auth::user()->foto)
                <img src="{{ asset('storage/uploads/user/' . Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; object-fit: cover;">
            @else
                <img src="{{ asset('adminlte/dist/img/default-user.png') }}" class="img-circle elevation-2" alt="User Image">
            @endif
        @endauth
    </div>
    <div class="info">
        <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->nama ?? 'User' }}</a>
    </div>
</div>
    <!-- SidebarSearch Form --> 
    <div class="form-inline mt-2"> 
      <div class="input-group" data-widget="sidebar-search"> 
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">       <div class="input-group-append"> 
          <button class="btn btn-sidebar"> 
            <i class="fas fa-search fa-fw"></i> 
          </button> 
        </div> 
      </div> 
    </div> 
    <!-- Sidebar Menu --> 
    <nav class="mt-2"> 
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
        <li class="nav-item"> 
          <a href="{{ url('/') }}" class="nav-link  {{ ($activeMenu == 'dashboard')? 
  'active' : '' }} "> 
            <i class="nav-icon fas fa-tachometer-alt"></i> 
            <p>Dashboard</p> 
          </a> 
        </li> 
        <li class="nav-item"> 
          <a href="{{ route('profile.edit') }}" class="nav-link {{ ($activeMenu == 'profile')? 'active' : '' }}">
            <i class="nav-icon fas fa-user-edit"></i>
            <p>Edit Profil</p>
          </a>
        </li> 
        
        <li class="nav-header">Data Pengguna</li> 
        <li class="nav-item"> 
          <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level')? 
  'active' : '' }} "> 
            <i class="nav-icon fas fa-layer-group"></i> 
            <p>Level User</p> 
          </a> 
        </li> 
        <li class="nav-item"> 
          <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user')? 
  'active' : '' }}"> 
            <i class="nav-icon far fa-user"></i> 
            <p>Data User</p> 
          </a> 
        </li> 
        <li class="nav-header">Data Barang</li> 
        <li class="nav-item"> 
          <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 
  'kategori')? 'active' : '' }} "> 
            <i class="nav-icon far fa-bookmark"></i> 
            <p>Kategori Barang</p> 
          </a> 
        </li> 
        <li class="nav-item">
            <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier')? 'active' : '' }} ">
                <i class="nav-icon fas fa-truck"></i>
                <p>Data Supplier</p>
            </a>
        </li>  
        <li class="nav-item"> 
          <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 
  'barang')? 'active' : '' }} "> 
            <i class="nav-icon far fa-list-alt"></i> 
            <p>Data Barang</p> 
          </a> 
        </li> 
        <li class="nav-header">Data Transaksi</li> 
        <li class="nav-item"> 
          <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok')? 
  'active' : '' }} "> 
            <i class="nav-icon fas fa-cubes"></i> 
            <p>Stok Barang</p> 
          </a> 
        </li> 
        <li class="nav-item">
          <a href="{{ url('/transaksi') }}" class="nav-link {{ ($activeMenu == 'penjualan')? 'active' : '' }} ">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>Transaksi Penjualan</p>
          </a>
      </li> 
        <li class="nav-item">
          <form id="logout-form-sidebar" action="{{ url('logout') }}" method="GET">
              @csrf
              <button type="submit" class="nav-link btn btn-danger text-left w-100">
                  <i class="fas fa-sign-out-alt"></i> Logout
              </button>
          </form>
      </li>
      </ul> 
    </nav> 
  </div>  
  