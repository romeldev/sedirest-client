<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- color de la barra de navegacion en dispositivos moviles y de la barra de menu en desktop --}}
    <meta name="theme-color" content="#E8EE37">
    {{-- indicar a los dispositivos moviles que la pagina esta optimizada para movil --}}
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">


    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <link rel="icon" href="{{ asset('img/logo_32.png') }}"> --}}
    {{-- <link rel="shortcut-icon"  type="image/png" href="{{ asset('img/logo_32.png') }}"> --}}

    <link rel="icon" href="{{ asset('icons/restaurant.svg') }}" type="image/svg+xml">
    <link rel="shortcut-icon" href="{{ asset('icons/restaurant.svg') }}" type="image/svg+xml">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
{{-- <body> --}}
<body class="hold-transition sidebar-collapse sidebar-mini layout-navbar-fixed layout-fixed">
    <div id="app">
        @yield('content')
    </div>
   

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap ') }}4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE ') }}App -->
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo ') }}purposes -->
    {{-- <script src="{{ asset('template/dist/js/demo.js') }}"></script> --}}

     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
