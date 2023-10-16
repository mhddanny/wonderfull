<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('img/userlogo.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          @if(Auth::check())
              {{ Auth::user()->name }}</p>
          @endif
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('kategori.index') }}" class="nav-link">
              <i class="nav-icon far fa fa-th"></i>
              <p>
                Kategori
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('produk.index') }}" class="nav-link">
              <i class="nav-icon far fa fa-cart-plus"></i>
              <p>
                Produk
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link">
              <i class="nav-icon far fas fa-shopping-bag"></i>
              <p>
                Pesanan
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('transaksi_masuk.index') }}" class="nav-link">
              <i class="nav-icon far fas fa-tasks"></i>
              <p>
                Transaksi Masuk
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('report_penjualan') }}" class="nav-link">
              <i class="nav-icon far fas fa-book"></i>
              <p>
                Report Penjualan
              </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa fa-cogs"></i>
              <p>
                Manager Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('supplier.index') }}" class="nav-link">
                  <i class="far fa fa-users nav-icon"></i>
                  <p>Suppilert</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pegawai.index') }}" class="nav-link">
                  <i class="far fas fa-user-tie nav-icon"></i>
                  <p>Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('customer.index') }}" class="nav-link">
                  <i class="far fas fa-users nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('agen') }}" class="nav-link">
                  <i class="far fa fa-user-secret nav-icon"></i>
                  <p>Agen</p>
                </a>
              </li>
            </ul>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
