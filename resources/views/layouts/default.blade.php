<html>
<head>
    <title>App Name - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="container max-w-screen-xl mx-auto p-5 min-h-screen">
    @yield('content')
</div>
@extends('components.structure.footer')
</body>
</html>
