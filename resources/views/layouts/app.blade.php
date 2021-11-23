<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head></x-head>
<body>
@include('layouts.navigation')
<div class="container">
    {{ $slot }}
</div>
</body>
</html>
