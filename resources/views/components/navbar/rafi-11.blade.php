<div class="hidden md:flex fixed top-0 z-40 h-screen bg-white shadow-lg flex-col transition-all duration-300 ease-in-out"
  :class="open ? 'w-64' : 'w-16'"
  x-data="{ open: false, article: false }"
  @resize.window="open = window.innerWidth >= 768">

  {{-- Tombol --}}
  <div class="p-4 flex items-center justify-between border-b">
    @php $site = json_decode(\Storage::get('website.json'), true); @endphp
    <template x-if="open">
      @if (($site['type'] ?? null) === 'teks')
      <p class="text-2xl font-bold text-main">{{ $site['title'] }}</p>
      @elseif (($site['type'] ?? null) === 'image')
      <img src="{{ asset('storage/images/' . $site['image']) }}" alt=""
        class="max-h-12 object-contain">
      @endif
    </template>

    <button @click="open = !open" class="text-gray-500 hover:text-gray-700 focus:outline-none">
      <template x-if="!open">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </template>
      <template x-if="open">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </template>
    </button>
  </div>

  <nav class="flex-1 overflow-y-auto px-2 py-4 space-y-1">

    {{-- Beranda --}}
    <a href="{{ route('home') }}"
      class="flex items-center gap-3 px-4 py-2 rounded-md text-lg font-semibold transition-colors duration-300 
          {{ request()->routeIs('home') ? 'text-main' : 'text-gray-700 hover:text-main hover:bg-main/10' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 
            001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
      </svg>
      <span x-show="open">Beranda</span>
    </a>

    {{-- Dropdown Artikel --}}
    <a @click="open = true; article = !article"
    class="w-full flex justify-between items-center px-4 py-2 text-lg font-medium rounded-md 
          {{ request()->routeIs('article*', 'category*', 'tag*', 'detail') ? 'bg-main/10 text-main' : 'text-gray-700 hover:text-main hover:bg-gray-100' }}">
  <div class="flex items-center gap-3 font-semibold text-base">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" 
        class="w-5 h-5" fill="currentColor">
      <path d="M26 4H6a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2ZM8 8h16v2H8V8Zm0 4h16v2H8v-2Zm0 4h16v2H8v-2Zm0 4h10v2H8v-2Z" />
    </svg>
    <span x-show="open">Artikel</span>
  </div>

  <svg class="w-5 h-5 transition-transform duration-200"
    :class="{ 'rotate-180': article }" 
    fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M19 9l-7 7-7-7" />
  </svg>
</a>

    <div x-show="article && open" x-transition class="mt-1 space-y-1 pl-6">
      <a href="{{ route('article') }}"
        class="block px-4 py-2 text-base rounded-md font-semibold
                {{ request()->routeIs('article') ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
        Artikel Terbaru
      </a>
      @foreach ($category as $item)
      <a href="{{ route('category', ['category' => $item->slug]) }}"
        class="block px-4 py-2 text-base rounded-md 
                {{ request()->is('category/'.$item->slug) ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
        {{ $item->category }}
      </a>
      @endforeach
    </div>

    {{-- Kontak --}}
    <a href="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak"
      class="flex items-center gap-3 px-4 py-2 rounded-md text-lg font-semibold 
              {{ request()->is('*#kontak') ? 'bg-main/10 text-main' : 'text-gray-700 hover:text-main hover:bg-gray-100' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
      </svg>
      <span x-show="open">Kontak</span>
    </a>
  </nav>

  {{-- Search Bawah --}}
  <div class="px-4 py-3 gap-3" x-show="open">
    <form action="{{ route('article') }}" method="get" class="flex">
      <input type="text"
        name="search"
        value="{{ request('search') }}"
        class="flex-grow h-10 px-4 text-sm border border-gray-300 rounded-l-lg focus:border-main focus:ring-2 focus:ring-main/20"
        placeholder="Cari Artikel...">
      <button type="submit"
        class="h-10 px-4 bg-main text-white rounded-r-lg hover:bg-main/90">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </button>
    </form>
  </div>
</div>


{{-- mobile --}}
<div class="md:hidden fixed top-0 left-0 right-0 z-50 bg-white" x-data="{ open: false, articleOpen: false }">
  <div class="p-4 flex justify-between items-center border-b">
    <button @click="open = !open" class="p-2 rounded-lg border">
      <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <div x-show="open" x-transition class="bg-white shadow-lg border-t">
    <div class="p-4 space-y-2">
      <a href="{{ route('home') }}" class="block hover:text-main">Beranda</a>

      <!-- Artikel dengan toggle -->
      <div class="flex justify-between items-center">
        <a href="{{ route('article') }}" class="block hover:text-main">Artikel</a>
        <button @click="articleOpen = !articleOpen" type="button">
          <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': articleOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 9l-7 7-7-7" />
          </svg>
        </button>
      </div>

      <div x-show="articleOpen" class="pl-4 space-y-1">
        <a href="{{ route('article') }}" class="block hover:text-main">Artikel Terbaru</a>
        @foreach ($category as $item)
        <a href="{{ route('category', $item->slug) }}" class="block hover:text-main">{{ $item->category }}</a>
        @endforeach
      </div>

      <a href="#kontak" class="block hover:text-main">Kontak</a>
    </div>
    <div class="p-4 border-t">
      <form action="{{ route('article') }}" method="get" class="flex">
        <input type="text" name="search" value="{{ request('search') }}"
          placeholder="Cari artikel..." class="flex-grow border rounded-l-lg px-3 py-2 text-sm">
        <button type="submit" class="bg-main text-white px-4 rounded-r-lg">Cari</button>
      </form>
    </div>
  </div>
</div>