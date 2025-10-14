<div class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200" x-data="{ open: false, article: false }">
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
    <button
        @click="openDropdown = !openDropdown"
        class="flex items-center gap-1 px-2 py-1 
        {{ request()->routeIs('article*', 'category*', 'tag*', 'detail') ? 'text-main font-semibold' : 'text-gray-700 hover:text-main' }}">
        Artikel
        <svg class="w-4 h-4 transition-transform duration-200" 
            :class="{ 'rotate-180': openDropdown }" 
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="openDropdown" 
         @click.away="openDropdown = false" 
         x-transition
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

    {{-- Search --}}
    <div class="hidden md:flex w-[250px] lg:w-[320px]">
      <form action="{{ route('article') }}" method="get" class="relative w-full">
        <input type="text" name="search" value="{{ request('search') }}"
               class="w-full h-10 pl-4 pr-10 text-sm border rounded-full focus:ring-2 focus:ring-main/20 focus:border-main"
               placeholder="Cari Artikel...">
        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-main">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </form>
    </div>

    {{-- Mobile Toggle --}}
    <button @click="open = !open" class="md:hidden p-2 rounded-md text-gray-700 hover:text-main">
      <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  {{-- Mobile Menu --}}
  <div x-show="open" x-transition
       class="md:hidden bg-white border-t shadow-md">
    <div class="px-4 py-3 space-y-2">
      <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
        Beranda
      </a>

      <div>
        <button @click="article = !article"
                class="w-full flex justify-between items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
          <span>Artikel</span>
          <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': article }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div x-show="article" class="pl-4 space-y-1 mt-1">
          <a href="{{ route('article') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">
            Artikel Terbaru
          </a>
          @foreach ($category as $item)
            <a href="{{ route('category', ['category' => $item->slug]) }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">
              {{ $item->category }}
            </a>
          @endforeach
        </div>
      </div>

      <a href="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
        Kontak
      </a>
    </div>

    {{-- Mobile Search --}}
    <div class="px-4 py-3 border-t">
      <form action="{{ route('article') }}" method="get" class="relative">
        <input type="text" name="search" value="{{ request('search') }}"
               class="w-full h-10 pl-4 pr-10 text-sm border rounded-full focus:ring-2 focus:ring-main/20 focus:border-main"
               placeholder="Cari Artikel...">
        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-main">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </form>
    </div>
  </div>
</div>