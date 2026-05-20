<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <!-- Character encoding -->
    <meta charset="UTF-8">
    <!-- Viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compatibility with Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF token for security in Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page title -->
    <title>BUAP | Oferta Educativa</title>
    <!-- Description for SEO -->
    <meta name="description" content="BUAP | Oferta Educativa">
    <!-- Author -->
    <meta name="author" content="Edwin Alberto Hernández Flora">
    <meta name="author" content="Alex Zempoalteca Acotzi">
    <meta name="designer" content="Alejandro López Hernández">
    <meta name="designer" content="Fátima Sánchez Orantes">
    <!-- Keywords for SEO -->
    <meta name="keywords" content="BUAP,OFERTA,EDUCATIVA,EDUCATIVE,OFFER,DES,VD">
    <!-- Robots for SEO -->
    <meta name="robots" content="index, follow">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/escudos-buap/escudo_w_b.png') }}">
    <!-- Open Graph for social media sharing -->
    <meta property="og:title" content="BUAP | Oferta Educativa">
    <meta property="og:description" content="Oferta Educativa BUAP">
    <meta property="og:image" content="{{ asset('images/escudos-buap/escudo_w_b.png') }}">
    <meta property="og:url" content="{{ route('index') }}">
    <meta property="og:type" content="website">
    <!-- Twitter Card for social media -->
    <meta name="twitter:card" content="Oferta Educativa BUAP">
    <meta name="twitter:title" content="BUAP | Oferta Educativa">
    <meta name="twitter:description" content="Oferta Educativa BUAP">
    <meta name="twitter:image" content="{{ asset('images/escudos-buap/escudo_w_b.png') }}">
    <!-- Theme color -->
    <meta name="theme-color" content="#ffffff">
    <!-- Link a fuente sources sans pro-->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <!-- Styles and Scripts -->
    @vite('resources/css/app.css')
    @yield('css')
</head>
<body>
    @yield('header')

    @yield('content')

    @yield('footer')


    @vite('resources/js/app.js')
    @include('sweetalert::alert')
    @yield('js')
</body>
</html>
