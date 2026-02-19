<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'My Portfolio') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Custom Styles -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        @include('partials.header')

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="footer-content">
                <p>&copy; {{ date('Y') }} John Doe. All rights reserved.</p>
            </div>
        </footer>
        <!-- Scripts -->
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
