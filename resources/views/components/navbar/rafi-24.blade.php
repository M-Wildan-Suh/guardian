<div x-data="{ open: false, article: false, openSearch: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200">

    <div class="max-w-[1200px] mx-auto px-4 md:px-8 h-16 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            @php $site = json_decode(\Storage::get('website.json'), true); @endphp
            @if (($site['type'] ?? null) === 'teks')
                <p class="text-2xl sm:text-3xl font-bold text-main tracking-wide">{{ $site['title'] }}</p>
            @elseif (($site['type'] ?? null) === 'image')
                <img src="{{ asset('storage/images/' . $site['image']) }}" alt="Logo" class="h-10 object-contain">
            @endif
        </a>

        {{-- Menu Desktop --}}
        <div class="hidden md:flex items-center space-x-6 font-semibold text-lg">
            <a href="{{ route('home') }}"
                class="relative px-2 py-1 {{ request()->routeIs('home') ? 'text-main font-semibold' : 'text-gray-700 hover:text-main' }}">
                Beranda
            </a>

            {{-- Artikel Dropdown --}}
            <div x-data="{ openDropdown: false }" class="relative">
                <button @click="openDropdown = !openDropdown"
                    class="flex items-center gap-1 px-2 py-1 
        {{ request()->routeIs('article*', 'category*', 'tag*', 'detail') ? 'text-main font-semibold' : 'text-gray-700 hover:text-main' }}">
                    Artikel
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': openDropdown }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="openDropdown" @click.away="openDropdown = false" x-transition
                    class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                    <a href="{{ route('article') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-main">
                        Artikel Terbaru
                    </a>
                    @foreach ($category as $item)
                        <a href="{{ route('category', ['category' => $item->slug]) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-main">
                            {{ $item->category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak"
                class="relative px-2 py-1 {{ request()->is('*#kontak') ? 'text-main font-semibold' : 'text-gray-700 hover:text-main' }}">
                Kontak
            </a>
        </div>

        {{-- Search & Mobile Menu Icons --}}
        <div class="flex items-center space-x-3">
            {{-- Search Button --}}
            <button @click="openSearch = true" class="p-2 rounded-full text-gray-700 hover:text-main transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            {{-- Mobile Hamburger --}}
            <button @click="open = !open" class="md:hidden p-2 rounded-md text-gray-700 hover:text-main">
                <svg x-show="!open" x-transition class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" x-transition class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Overlay Background --}}
    <div x-show="open || openSearch" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40"
        @click="open = false; openSearch = false">
    </div>

    {{-- Search Overlay --}}
    <div x-show="openSearch" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="-translate-y-full opacity-0"
        class="fixed top-0 left-0 w-full bg-white shadow-lg border-b border-gray-200 backdrop-blur-md z-50"
        @click.away="openSearch = false">
        <div class="max-w-[800px] mx-auto px-4 py-6 relative">
            {{-- Close Button --}}
            <button @click="openSearch = false" class="absolute right-4 top-4 text-gray-600 hover:text-main">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <form action="{{ route('article') }}" method="get" class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full h-12 pl-5 pr-12 text-base border rounded-full focus:ring-2 focus:ring-main/20 focus:border-main transition-all"
                    placeholder="Cari artikel yang kamu inginkan...">
                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-main">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>

            {{-- Tag Populer --}}
            <div class="mt-4 flex flex-wrap gap-2">
                <p class="text-sm text-gray-600 w-full mb-1">🔥 Tag Populer:</p>
                @foreach ($category as $item)
                    <a href="{{ route('category', ['category' => $item->slug]) }}"
                        class="px-3 py-1 text-sm rounded-full border border-gray-200 text-gray-700 hover:bg-main hover:text-white transition">
                        {{ $item->category }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="-translate-y-full opacity-0"
        class="md:hidden fixed top-0 left-0 w-full bg-white border-t shadow-md z-50 mt-16">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
                Beranda
            </a>

            <div>
                <button @click="article = !article"
                    class="w-full flex justify-between items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                    <span>Artikel</span>
                    <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': article }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="article" x-transition class="pl-4 space-y-1 mt-1">
                    <a href="{{ route('article') }}"
                        class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">
                        Artikel Terbaru
                    </a>
                    @foreach ($category as $item)
                        <a href="{{ route('category', ['category' => $item->slug]) }}"
                            class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">
                            {{ $item->category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak"
                class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                Kontak
            </a>
        </div>
    </div>
</div>
