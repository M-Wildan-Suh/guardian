<div class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-200">
  <div class="max-w-[1200px] mx-auto px-4 md:px-8 py-3 flex items-center justify-between">
    {{-- Navbar --}}
    <div class="hidden md:flex items-center space-x-8">
      <a href="{{ route('home') }}" class="text-gray-700 hover:text-main font-semibold transition duration-200">Beranda</a>

      {{-- Dropdown --}}
      <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="flex items-center gap-1 text-gray-700 hover:text-main font-semibold transition duration-200 overflow-visible">
          Artikel
          <i class="fas fa-chevron-down text-xs transition-transform duration-200" 
         :class="{ 'rotate-180': open }"></i>
        </button>
        <div x-show="open" @click.away="open = false"
          class="absolute left-0 mt-3 bg-white shadow-lg rounded-lg p-3 w-56 space-y-1"
          x-transition>
          <a href="{{ route('article') }}" class="block px-3 py-2 text-gray-700 hover:bg-main/10 rounded transition duration-200">Artikel Terbaru</a>
          @foreach ($category as $item)
          <a href="{{ route('category', ['category' => $item->slug]) }}"
            class="block px-3 py-2 text-gray-700 hover:bg-main/10 rounded transition duration-200">{{ $item->category }}</a>
          @endforeach
        </div>
      </div>

      <a href="#kontak" class="text-gray-700 hover:text-main font-semibold transition duration-200">Kontak</a>
    </div>

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="absolute left-1/2 transform -translate-x-1/2 flex-shrink-0">
    @php $site = json_decode(\Storage::get('website.json'), true); @endphp
    @if (($site['type'] ?? null) === 'teks')
      <p class="text-2xl font-bold text-main">{{ $site['title'] }}</p>
    @elseif (($site['type'] ?? null) === 'image')
      <img src="{{ asset('storage/images/' . $site['image']) }}" alt="Logo" class="h-10 object-contain">
    @endif
  </a>

    {{-- Search --}}
    <div class="hidden md:flex items-center space-x-4">
      <div x-data="{ searchOpen: false }" class="relative">
        <button @click="searchOpen = !searchOpen" class="text-gray-600 hover:text-main">
          <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 10-14 0 7 7 0 0014 0z" />
          </svg>
        </button>
        <form x-show="searchOpen" x-transition @click.away="searchOpen = false" method="get" action="{{ route('article') }}"
          class="absolute right-0 mt-2 bg-white p-2 rounded-lg shadow-lg flex">
          <input type="text" name="search" placeholder="Cari..."
            class="border border-gray-300 rounded-l-lg px-3 py-1 focus:outline-none focus:border-main">
          <button type="submit" class="bg-main text-white px-3 rounded-r-lg hover:bg-main/90">Cari</button>
        </form>
      </div>
    </div>

    {{-- Mobile Menu Button --}}
    <button @click="open = !open" class="md:hidden p-2 text-gray-700 hover:text-main" x-data="{ open: false }">
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
  <div x-show="open" x-transition class="md:hidden bg-white shadow-lg border-t">
    <div class="px-4 py-3 space-y-2">
      <a href="{{ route('home') }}" class="block py-2">Beranda</a>
      <a href="{{ route('article') }}" class="block py-2">Artikel Terbaru</a>
      @foreach ($category as $item)
      <a href="{{ route('category', ['category' => $item->slug]) }}" class="block py-2">{{ $item->category }}</a>
      @endforeach
      <a href="#kontak" class="block py-2">Kontak</a>
    </div>
  </div>
</div>