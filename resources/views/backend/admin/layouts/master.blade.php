<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="{{ config('app.charset', 'UTF-8') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
       <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
    
<div id="app">

<div class="flex">
    @include('backend.admin.layouts.pratins.sidebar')
    <div class="flex flex-col flex-1 min-h-screen">
@include('backend.admin.layouts.pratins.header')

@yield('content')
 
@include('backend.admin.layouts.pratins.footer')
</div>
</body>
</html>