<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

   <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  {{-- //asset css --}}
  {{-- <livewire:styles /> --}}
  @include('admin.layouts._asset_header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    {{-- Navbar --}}
    @include('admin.layouts.header')
    {{-- sidebar --}}
    @include('admin.layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    {{-- footer --}}
    @include('admin.layouts.footer')
  </div>
<!-- ./wrapper -->

{{-- asser script --}}
@include('admin.layouts._asset_footer')
{{-- <livewire:scripts /> --}}
</body>
</html>
