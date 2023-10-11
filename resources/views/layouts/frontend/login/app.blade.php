<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MEBNI</title>
    <meta name="description" content="MEBNI" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://mebni.org" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/logo_mebni.png') }}">
</head>

<body>
    @yield('content')
</body>

</html>
