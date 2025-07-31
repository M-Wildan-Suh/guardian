@props(['title' => null, 'template' => 'type-a', 'desc' => null, 'tags' => null, 'footer' => true, 'category' => null,])
<!DOCTYPE html>
<html class=" scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon"
        href="{{ optional(json_decode(\Storage::get('website.json'), true))['icon'] ? asset('/storage/images/' . json_decode(\Storage::get('website.json'), true)['icon']) : null }}"
        type="image/x-icon">

    <title>{{ $title ?? '' }}</title>

    <meta name="description" content="{{ $desc ?? '' }}">
    <meta name="keywords" content="{{ collect($tags)->pluck('tag')->implode(', ') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $title ?? '' }}">
    <meta property="og:description" content="{{ $desc ?? '' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name"
        content="{{ optional(json_decode(\Storage::get('website.json'), true))['title'] ?? null }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"
        :required="true" />

    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        /* Backgroudn */

        .bg-background {
            background-color: var(--background);
        }

        .hover\:bg-background {
            background-color: var(--background);
        }        
        
        .text-background {
            color: var(--second);
        }

        .hover\:text-background:hover {
            color: var(--second);
        }

        .border-background {
            border-color: var(--second);
        }

        .hover\:border-background:hover {
            border-color: var(--second);
        }


        /* Main */

        .bg-main {
            background-color: var(--main);
        }

        .hover\:bg-main:hover {
            background-color: var(--main);
        }

        .text-main {
            color: var(--main);
        }

        .hover\:text-main:hover {
            color: var(--main);
        }

        .border-main {
            border-color: var(--main);
        }

        .hover\:border-main:hover {
            border-color: var(--main);
        }

        /* Second */

        .bg-second {
            background-color: var(--second);
        }

        .hover\:bg-second:hover {
            background-color: var(--second);
        }

        .text-second {
            color: var(--second);
        }

        .hover\:text-second:hover {
            color: var(--second);
        }

        .border-second {
            border-color: var(--second);
        }

        .hover\:border-second:hover {
            border-color: var(--second);
        }

        /* Third */

        .bg-third {
            background-color: var(--third);
        }
        
        .hover\:bg-third:hover {
            background-color: var(--third);
        }

        .text-third {
            color: var(--third);
        }

        .hover\:text-third:hover {
            color: var(--third);
        }

        .border-third {
            border-color: var(--third);
        }

        .hover\:border-third:hover {
            border-color: var(--third);
        }
    </style>

    @endif

</head>

<body class="font-sans antialiased" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 1000)"
    @beforeunload.window="loading = true" @load.window="setTimeout(() => loading = false, 1000)"
    @pageshow.window="loading = false">
    <!-- Loading overlay -->
    <div x-show="loading" class="fixed inset-0 z-[200] flex items-center justify-center bg-background"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <!-- Animasi tiga titik meloncat -->
        <div class="flex space-x-2">
            <div class="dot w-4 h-4 bg-main rounded-full animate-bounce delay-0"></div>
            <div class="dot w-4 h-4 bg-second rounded-full animate-bounce delay-200"></div>
            <div class="dot w-4 h-4 bg-third rounded-full animate-bounce delay-400"></div>
        </div>
    </div>
    {{-- Search Overlay Fullscreen --}}
    <div x-show="searchOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-md bg-black/30 px-4" x-cloak>
        <div class="bg-white w-full max-w-xl rounded-xl shadow-lg p-6 relative">
            <button @click="searchOpen = false" class="absolute top-3 right-3 text-gray-400 hover:text-main transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form action="{{ route('article') }}" method="get" class="flex items-center gap-3 mt-4">
                <input type="text" name="search" placeholder="Cari artikel di sini..."
                    class="flex-grow px-4 py-3 text-lg border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-main/30 transition"
                    autofocus />
                <button type="submit" class="bg-main text-white px-5 py-3 rounded-full hover:bg-main/90 transition">
                    Cari
                </button>
            </form>
        </div>
    </div>

    <style>
        /* Menambahkan delay pada animasi */
        .animate-bounce {
            animation: bounce 0.6s infinite alternate;
        }

        .delay-0 {
            animation-delay: 0s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        /* Keyframes untuk animasi bounce */
        @keyframes bounce {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-8px);
            }
        }
    </style>
    <div class=" flex flex-col w-full min-h-[100vh] justify-between bg-neutral-100">
        @include('components.navbar.' . $template)
        {{ $slot }}
        @if ($footer)
            @include('components.footer.type-a')
        @endif
    </div>
</body>

<script src="{{ asset('build/assets/app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</html>
