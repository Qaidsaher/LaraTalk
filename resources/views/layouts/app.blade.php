<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script>
            window.currentUser = {
                id: {{ $currentUser->id }},
                name: "{{ $currentUser->name }}"
            };
        </script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {


                // Listen for private events
                window.Echo.private(`App.User.${window.currentUser.id}`)
                    .listen('.message.sent', (e) => {
                        console.log("Private Event received:", e);
                        alert('message from private'+e.message)
                    });

                // Listen for public events
                window.Echo.channel('public-updates')
                    .listen('.message.sent', (e) => {
                        console.log("Public Event received:", e);
                        alert('message from public'+e.message)
                    });


            });
        </script>
    </body>
</html>
