<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  @include('subview._asset_header')

  @include('subview._asset_footer')

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Collect the nav links, forms, and other content for toggling -->
    @include('subview.navbar')
    <!-- Left side column. contains the logo and sidebar -->
    @include('subview.menu')

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  @include('subview.footer')

</body>
</html>
