{{-- Navigation --}}
<div class="sticky top-0 z-40 bg-white shadow-md" x-data="{ open: false, article: false }">
    <div class="max-w-[1080px] mx-auto px-4 md:px-8 py-4 flex justify-between items-center">
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

        {{-- Menu Desktop --}}
        <div class="hidden md:flex items-center space-x-6 text-gray-700 font-medium ml-auto">
            <x-navbar.button.rafi-1 title="Beranda" :route="route('home')" :active="['home']" :mobile="false" />

            <div class="relative group">
                <button
                    class="{{ request()->routeIs('article*', 'author*', 'category*', 'tag*', 'detail') ? 'text-white bg-second' : 'text-black hover:text-white hover:bg-second' }} px-5 py-1.5 rounded-full transition duration-300">
                    Artikel
                </button>
                <div
                    class="absolute hidden group-hover:flex flex-col bg-white rounded-md shadow-lg mt-2 py-2 z-30 w-48 text-sm text-gray-700">
                    <a href="{{ route('article') }}" class="px-4 py-2 hover:bg-gray-100 transition">Artikel Terbaru</a>
                    @foreach ($category as $item)
                        <a href="{{ route('category', ['category' => $item->slug]) }}"
                            class="px-4 py-2 hover:bg-gray-100 transition">{{ $item->category }}</a>
                    @endforeach
                </div>
            </div>

            <x-navbar.button.rafi-1 title="Kontak"
                route="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak" :active="null"
                :mobile="false" />
        </div>

        {{-- Search --}}
        <div class="hidden md:flex items-center w-96">
            <form action="{{ route('article') }}" class="w-full" method="get">
                <div class=" flex items-center px-10 justify-between h-10 bg-white">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="flex-grow h-10 text-sm px-4 sm:px-6 border-r-0 rounded-l-full focus:border-main focus:ring-0"
                        placeholder="Cari Artikel....">
                    <button class=" px-6 bg-main hover:bg-third rounded-r-full text-white duration-300 h-10"
                        aria-label="cari">
                        <div class=" w-[18px] aspect-square overflow-hidden">
                            <svg aria-hidden="true" class="e-font-icon-svg e-fas-search" viewBox="0 0 512 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                </path>
                            </svg>
                        </div>
                    </button>
                </div>
            </form>
        </div>

        {{-- Mobile Menu Button --}}
        <button @click="open = !open" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6 text-main" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" @click.outside="open = false"
        class="md:hidden flex flex-col px-4 py-4 bg-white space-y-4 border-t text-sm font-semibold text-gray-700">
        <x-navbar.button.rafi-1 title="Beranda" :route="route('home')" :active="['home']" :mobile="true" />

        <div>
            <button @click="article = !article"
                class="w-full text-center py-2 rounded-full hover:bg-second hover:text-white transition">
                Artikel
            </button>
            <div x-show="article" class="mt-2 space-y-1">
                <a href="{{ route('article') }}" class="block px-4 py-2 hover:bg-gray-100">Artikel Terbaru</a>
                @foreach ($category as $item)
                    <a href="{{ route('category', ['category' => $item->slug]) }}"
                        class="block px-4 py-2 hover:bg-gray-100">{{ $item->category }}</a>
                @endforeach
            </div>
        </div>

        <x-navbar.button.rafi-1 title="Kontak" :route="null" :active="null" :mobile="true" />

        <form action="{{ route('article') }}" method="get">
            <div class=" flex items-center justify-between h-10 bg-white">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="flex-grow h-10 text-sm px-4 sm:px-6 border-r-0 rounded-l-full focus:border-main focus:ring-0"
                    placeholder="Cari Artikel....">
                <button class=" px-6 bg-main hover:bg-third rounded-r-full text-white duration-300 h-10"
                    aria-label="cari">
                    <div class=" w-[18px] aspect-square overflow-hidden">
                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-search" viewBox="0 0 512 512"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>
