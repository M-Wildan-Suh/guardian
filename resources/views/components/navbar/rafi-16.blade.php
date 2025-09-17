<div class="sticky top-0 z-40 bg-white border-b border-gray-200" x-data="{ open: false }">
  <div class="max-w-[1200px] mx-auto px-6 py-5 flex items-center justify-between">
    
    {{-- Logo --}}
    <a href="{{ route('home') }}" class="text-3xl font-bold text-main">{{ $site['title'] ?? 'Bizlink' }}</a>

    {{-- Menu --}}
    <div class="hidden md:flex items-center space-x-10 font-semibold text-md">
      <a href="{{ route('home') }}" class="text-md text-gray-700 hover:text-main">Beranda</a>

      {{-- Dropdown --}}
      <div x-data="{ openDropdown:false }" class="relative">
        <button @click="openDropdown=!openDropdown" class="flex items-center gap-1 text-md font-semibold text-gray-700 hover:text-main">
          Artikel <i class="fas fa-chevron-down text-xs" :class="{ 'rotate-180':openDropdown }"></i>
        </button>
        <div x-show="openDropdown" @click.away="openDropdown=false" x-transition
             class="absolute mt-2 bg-white rounded-lg shadow-lg p-4 grid grid-cols-1 gap-2 w-72">
          <a href="{{ route('article') }}" class="px-3 py-2 hover:bg-main/10 rounded">Artikel Terbaru</a>
          @foreach ($category as $item)
            <a href="{{ route('category', ['category'=>$item->slug]) }}" class="px-3 py-2 hover:bg-main/10 rounded">{{ $item->category }}</a>
          @endforeach
        </div>
      </div>

      <a href="#kontak" class="text-md font-semibold text-gray-700 hover:text-main">Kontak</a>
    </div>

    {{-- Search --}}
    <div class="hidden md:block">
      <form method="get" action="{{ route('article') }}" class="flex border border-gray-300 rounded">
        <input name="search" placeholder="Cari..." class="px-3 py-1 text-sm focus:outline-none">
        <button class="bg-main text-white px-3 rounded-r">Cari</button>
      </form>
    </div>

    {{-- Mobile Button --}}
    <button @click="open=!open" class="md:hidden">
      <i x-show="!open" class="fas fa-bars"></i>
      <i x-show="open" class="fas fa-times"></i>
    </button>
  </div>

  {{-- Mobile Menu --}}
  <div x-show="open" x-transition class="md:hidden bg-white border-t">
    <div class="px-4 py-3 space-y-2">
      <a href="{{ route('home') }}" class="block">Beranda</a>
      <a href="{{ route('article') }}" class="block">Artikel Terbaru</a>
      @foreach ($category as $item)
      <a href="{{ route('category', ['category'=>$item->slug]) }}" class="block">{{ $item->category }}</a>
      @endforeach
      <a href="#kontak" class="block">Kontak</a>
    </div>
  </div>
</div>
