<html>
<head>
    <title>App Name - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="container max-w-screen-xl mx-auto p-5 min-h-screen">
    @yield('content')
</div>
@extends('components.structure.footer')
</body>
</html>
