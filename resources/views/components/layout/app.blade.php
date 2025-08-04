<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" :required="true"/>

        <!-- CDN -->

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet" />

    </head>
    <body>
        <div class=" flex w-full h-screen justify-center items-center p-4 sm:p-8 bg-main">
            <div class=" overflow-auto bg-white w-full max-w-xl max-h-full rounded-md shadow-md shadow-black/20">
                {{$slot}}
            </div>
        </div>
    </body>
    <script src="{{ asset('build/assets/app.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>