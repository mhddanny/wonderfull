<!DOCTYPE html>
<html lang="lang="{{ str_replace('_', '-', app()->getLocale()) }}"">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- <link rel="icon" type="{{ asset('eshop/image/png')}}" href="{{ asset('eshop/images/favicon.png') }}"> --}}
    @include('web.layouts._asset_header')

</head><!--/head-->

<body>
  @include('web.layouts.header')

	@yield('section')

  @include('web.layouts.footer')

  @include('web.layouts._asset_footer')
</body>
</html>
