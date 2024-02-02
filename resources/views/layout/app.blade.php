<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Ecommerce</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/css/intlTelInput.css">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.ico"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    @include('layout.header')
    @include('layout.mobile_header')
    <main class="main">
        @yield('content')
    </main>

    @include('layout.footer');
