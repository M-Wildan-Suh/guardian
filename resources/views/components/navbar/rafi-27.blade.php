<div class="sticky top-0 z-50 bg-white shadow" x-data="{ open: false, articleOpen: false }">
    <div class="max-w-[1080px] mx-auto px-4 md:px-8 py-3 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <div class="h-10 sm:h-12 flex items-center overflow-hidden">
                @php $site = json_decode(\Storage::get('website.json'), true); @endphp
                @if (($site['type'] ?? null) === 'teks')
                    <p class="text-2xl sm:text-3xl font-bold text-main">{{ $site['title'] }}</p>
                @elseif (($site['type'] ?? null) === 'image')
                    <img src="{{ asset('storage/images/' . $site['image']) }}" alt=""
                        class="max-h-full max-w-full object-contain">
                @endif
            </div>
        </a>

        {{-- Desktop --}}
        <form action="{{ route('article') }}" method="get" class="hidden md:flex flex-1 max-w-md mx-6">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..."
                    class="w-full border rounded-lg pl-10 pr-3 py-2 text-sm focus:ring-main focus:border-main">
                <svg class="absolute w-5 h-5 left-3 top-2.5 text-gray-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </form>

        <ul class="hidden md:flex items-center text-md font-semibold gap-6">
            <li><a href="{{ route('home') }}" class="hover:text-main">Beranda</a></li>
            <li class="relative" @mouseenter="articleOpen = true" @mouseleave="articleOpen = false">
                <a href="#" class="hover:text-main flex items-center">
                    Artikel
                    <svg class="ml-1 w-4 h-4" :class="{ 'rotate-180': articleOpen }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                <div x-show="articleOpen" x-transition
                    class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-lg overflow-hidden">
                    <a href="{{ route('article') }}" class="block px-4 py-2 hover:bg-gray-100">Artikel Terbaru</a>
                    @foreach ($category as $item)
                        <a href="{{ route('category', $item->slug) }}"
                            class="block px-4 py-2 hover:bg-gray-100">{{ $item->category }}</a>
                    @endforeach
                </div>
            </li>
            <li><a href="#kontak" class="hover:text-main">Kontak</a></li>
        </ul>

        {{-- Mobile --}}
        <button @click="open = !open" class="md:hidden p-2 rounded-lg border">
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-transition class="md:hidden bg-white shadow-lg border-t">
        <div class="p-4 space-y-2">
            <a href="{{ route('home') }}" class="block hover:text-main">Beranda</a>
            <button @click="articleOpen = !articleOpen"
                class="w-full flex justify-between items-center hover:text-main">
                Artikel
                <svg class="w-5 h-5" :class="{ 'rotate-180': articleOpen }" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="articleOpen" class="pl-4 space-y-1">
                <a href="{{ route('article') }}" class="block hover:text-main">Artikel Terbaru</a>
                @foreach ($category as $item)
                    <a href="{{ route('category', $item->slug) }}"
                        class="block hover:text-main">{{ $item->category }}</a>
                @endforeach
            </div>
            <a href="#kontak" class="block hover:text-main">Kontak</a>
        </div>
        <div class="p-4 border-t">
            <form action="{{ route('article') }}" method="get" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..."
                    class="flex-grow border rounded-l-lg px-3 py-2 text-sm">
                <button type="submit" class="bg-main text-white px-4 rounded-r-lg">Cari</button>
            </form>
        </div>
    </div>
</div>
