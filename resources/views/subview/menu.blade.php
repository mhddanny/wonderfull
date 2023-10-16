<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('img/userlogo.png') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        @if(Auth::check())
            {{ Auth::user()->name }}</p>
        @endif
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span></span>
            <span class="pull-right-container">Master User
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Auth::user()->level == 'admin')
              <li><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> User</a></li>
              <li><a href="{{ route('supplier.index') }}"><i class="fa fa-users"></i> Suppiler</a></li>
              <li><a href="{{ route('pegawai.index') }}"><i class="fa fa-user-o"></i> Pegawai</a></li>
          @endif
          <li><a href="{{ route('customer.index') }}"><i class="fa fa-users"></i> Customer</a></li>
          <li><a href="{{ route('agen') }}"><i class="fa fa-user-secret"></i> Agen</a></li>
          </ul>
        </li>
        <li><a href="{{ route('kategori.index') }}"><i class="fa fa-th"></i>Manegemen Kategori</a></li>
        <li><a href="{{ route('produk.index') }}"><i class="fa fa-cart-plus"></i> Manegemen Produk</a></li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="nav-icon icon-drop"></i> Pesanan
            </a>
        </li>
        <li>
          <a href="{{ route('transaksi_masuk.index') }}">
            <i class="fa fa-files-o"></i> <span>Transaksi Masuk</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>

        <li>
          <a href="{{ route('report_penjualan') }}">
            <i class="fa fa-files-o"></i> <span>Report Penjualan</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@yield('title')</li>
      </ol>
    </section>
