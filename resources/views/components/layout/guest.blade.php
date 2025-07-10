@props(['title' => null, 'template' => 'type-a', 'desc' => null, 'tags' => null, 'footer' => true, 'category' => null])
<!DOCTYPE html>
<html class=" scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ optional(json_decode(\Storage::get('website.json'), true))['icon'] ? asset('/storage/images/' . json_decode(\Storage::get('website.json'), true)['icon']) : null }}" type="image/x-icon">

        <title>{{ $title ?? '' }}</title>

        <meta name="description" content="{{ $desc ?? '' }}">
        <meta name="keywords" content="{{ collect($tags)->pluck('tag')->implode(', ') }}">
        <link rel="canonical" href="{{ url()->current() }}">

        <meta property="og:title" content="{{$title ?? ''}}">
        <meta property="og:description" content="{{ $desc ?? '' }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ optional(json_decode(\Storage::get('website.json'), true))['title'] ?? null }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" :required="true"/>

        <!-- CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet" />

    </head>
    <body class="font-sans antialiased"
        x-data="{ loading: true }" 
        x-init="setTimeout(() => loading = false, 1000)"
        @beforeunload.window="loading = true"
        @load.window="setTimeout(() => loading = false, 1000)"
        @pageshow.window="loading = false">
        <!-- Loading overlay -->
        <div x-show="loading" 
            class="fixed inset-0 z-[200] flex items-center justify-center bg-background"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <!-- Animasi tiga titik meloncat -->
            <div class="flex space-x-2">
                <div class="dot w-4 h-4 bg-main rounded-full animate-bounce delay-0"></div>
                <div class="dot w-4 h-4 bg-second rounded-full animate-bounce delay-200"></div>
                <div class="dot w-4 h-4 bg-third rounded-full animate-bounce delay-400"></div>
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
            @include('components.navbar.'.$template)
            {{$slot}}
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