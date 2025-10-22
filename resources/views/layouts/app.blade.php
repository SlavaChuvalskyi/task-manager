<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ str_replace('_', ' ', config('app.name', 'Laravel')) }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
<script src="{{ asset('assets/js/utils.js') }}" type="text/javascript"></script>

<!-- begin:: Page -->
@include('includes.sidebar')
<div class="flex flex-col w-full h-screen">
    @include('includes.header')
    @yield('content')
    @stack('scripts')
</div>

@yield('after-scripts')
<!-- end:: Page -->
</body>
