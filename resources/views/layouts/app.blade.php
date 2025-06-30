<!doctype html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Binary Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="h-full">
    <div class="min-h-full">
        @include('partials.nav')
        @include('partials.banner')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
</body>

</html>