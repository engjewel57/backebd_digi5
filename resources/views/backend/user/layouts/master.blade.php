<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="{{ config('app.charset', 'UTF-8') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title'){{ config('app.name', 'Laravel') }}</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
@include('backend.user.layouts.pratins.header')

<main class="py-4">
    @yield('content')
</main>

 
@include('backend.user.layouts.pratins.footer')

</body>
</html>