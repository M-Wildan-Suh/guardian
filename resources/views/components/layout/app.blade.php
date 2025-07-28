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

        @php
        $json = \Storage::get('template.json');
        $name = json_decode(\Storage::get('website.json'))->template;
        $data = json_decode($json, true);
        $theme = collect($data)->firstWhere('name', $name);
    @endphp

    @if (isset($theme))
    <style>
        :root {
            --background: {{ $theme['background'] ?? '#f5f5f5' }};
            --main: {{ $theme['main'] ?? '#0D5EA6' }};
            --second: {{ $theme['second'] ?? '#19282F' }};
            --third: {{ $theme['third'] ?? '#093FB5' }};
        }

        .bg-main {
            background-color: var(--main) !important;
        }
        .hover\:bg-main:hover {
            background-color: var(--main);
        }

        .bg-second {
            background-color: var(--second) !important;
        }
        .hover\:bg-second:hover {
            background-color: var(--second);
        }

        .bg-third {
            background-color: var(--third) !important;
        }
        .hover\:bg-third:hover {
            background-color: var(--third);
        }

        .text-main {
            color: var(--main) !important;
        }
        .hover\:text-main:hover {
            color: var(--main);
        }

        .text-second {
            color: var(--second) !important;
        }
        .hover\:text-second:hover {
            color: var(--second);
        }

        .text-third {
            color: var(--third) !important;
        }
        .hover\:text-third:hover {
            color: var(--third);
        }

        .border-main {
            border-color: var(--main) !important;
        }
        .hover\:border-main:hover {
            border-color: var(--main);
        }

        .border-second {
            border-color: var(--second) !important;
        }
        .hover\:border-second:hover {
            border-color: var(--second);
        }

        .border-third {
            border-color: var(--third) !important;
        }
        .hover\:border-third:hover {
            border-color: var(--third);
        }
    </style>

    @endif
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