<div class="sticky top-0 z-40 bg-white shadow-md" x-data="{ open: false, article: false }">
  <div class="max-w-[1080px] mx-auto px-4 md:px-8 py-4 flex justify-between items-center">
    {{-- Logo --}}
    <a href="{{ route('home') }}" class="flex items-center space-x-2">
      <div class="h-10 sm:h-12 flex items-center overflow-hidden">
        @php $site = json_decode(\Storage::get('website.json'), true); @endphp
        @if (($site['type'] ?? null) === 'teks')
        <p class="text-2xl sm:text-3xl font-bold text-main">{{ $site['title'] }}</p>
        @elseif (($site['type'] ?? null) === 'image')
        <img src="{{ asset('storage/images/' . $site['image']) }}" alt="" class="max-h-full max-w-full object-contain">
        @endif
      </div>
    </a>

    {{-- Menu Desktop --}}
    <div class="hidden md:flex items-center space-x-8 ml-auto">
      {{-- Beranda --}}
      <a href="{{ route('home') }}" 
         class="relative group px-2 py-1 text-lg font-medium text-gray-700 hover:text-main transition-colors duration-300
                {{ request()->routeIs('home') ? 'text-third font-semibold' : '' }}">
        Beranda
        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-main transition-all duration-300 group-hover:w-full {{ request()->routeIs('home') ? 'w-full' : '' }}"></span>
      </a>

      {{-- Artikel --}}
      <div x-data="{ articleOpen: false }" class="relative">
        <a href="{{ route('article') }}" 
           @mouseenter="articleOpen = true" 
           @mouseleave="articleOpen = false"
           class="relative group px-2 py-1 text-lg font-medium text-gray-700 hover:text-main transition-colors duration-300
                  {{ request()->routeIs('article*', 'category*', 'tag*', 'detail') ? 'text-main font-semibold' : '' }}">
          Artikel
          <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-main transition-all duration-300 group-hover:w-full {{ request()->routeIs('article*', 'category*', 'tag*', 'detail') ? 'w-full' : '' }}"></span>
          <svg class="w-4 h-4 inline ml-1 transition-transform duration-200" :class="{ 'rotate-180': articleOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </a>

        {{-- Dropdown Artikel --}}
        <div x-show="articleOpen" 
             @mouseenter="articleOpen = true" 
             @mouseleave="articleOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-1"
             class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
          <div class="py-1">
            <a href="{{ route('article') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-main {{ request()->routeIs('article') ? 'bg-gray-50 text-main' : '' }}">
              Artikel Terbaru
            </a>
            @foreach ($category as $item)
            <a href="{{ route('category', ['category' => $item->slug]) }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-main {{ request()->is('category/'.$item->slug) ? 'bg-gray-50 text-main' : '' }}">
              {{ $item->category }}
            </a>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Kontak --}}
      <a href="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak" 
         class="relative group px-2 py-1 text-lg font-medium text-gray-700 hover:text-main transition-colors duration-300
                {{ request()->is('*#kontak') ? 'text-main font-semibold' : '' }}">
        Kontak
        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-main transition-all duration-300 group-hover:w-full {{ request()->is('*#kontak') ? 'w-full' : '' }}"></span>
      </a>
    </div>

    {{-- Search Desktop --}}
    <div class="hidden md:flex items-center ml-8 w-96">
      <form action="{{ route('article') }}" class="w-full relative" method="get">
        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               class="w-full h-10 pl-4 pr-10 text-sm border border-gray-300 rounded-full focus:border-main focus:ring-2 focus:ring-main/20 transition-all duration-300" 
               placeholder="Cari Artikel...">
        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-main">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </form>
    </div>

    {{-- Mobile Menu Button --}}
    <button @click="open = !open" class="md:hidden p-2 rounded-md text-gray-700 hover:text-main focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" class="hidden"/>
      </svg>
    </button>
  </div>

  
  {{-- Mobile Menu --}}
  <div x-show="open" 
       x-transition:enter="transition ease-out duration-100"
       x-transition:enter-start="opacity-0 scale-95"
       x-transition:enter-end="opacity-100 scale-100"
       x-transition:leave="transition ease-in duration-75"
       x-transition:leave-start="opacity-100 scale-100"
       x-transition:leave-end="opacity-0 scale-95"
       class="md:hidden bg-white shadow-lg border-t">
    <div class="px-4 py-3 space-y-2">
      <a href="{{ route('home') }}" 
         class="block px-4 py-2 text-lg font-medium rounded-lg {{ request()->routeIs('home') ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
        Beranda
      </a>

      <div class="space-y-1">
        <button @click="article = !article" 
                class="w-full flex justify-between items-center px-4 py-2 text-lg font-medium rounded-lg {{ request()->routeIs('article*', 'category*', 'tag*', 'detail') ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
          <span>Artikel</span>
          <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': article }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        
        <div x-show="article" class="pl-6 space-y-1">
          <a href="{{ route('article') }}" 
             class="block px-4 py-2 text-base rounded-lg {{ request()->routeIs('article') ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
            Artikel Terbaru
          </a>
          @foreach ($category as $item)
          <a href="{{ route('category', ['category' => $item->slug]) }}" 
             class="block px-4 py-2 text-base rounded-lg {{ request()->is('category/'.$item->slug) ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
            {{ $item->category }}
          </a>
          @endforeach
        </div>
      </div>

      <a href="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak" 
         class="block px-4 py-2 text-lg font-medium rounded-lg {{ request()->is('*#kontak') ? 'bg-main/10 text-main' : 'text-gray-700 hover:bg-gray-100' }}">
        Kontak
      </a>
    </div>

    <div class="px-4 py-3 border-t">
      <form action="{{ route('article') }}" method="get" class="flex">
        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               class="flex-grow h-10 px-4 text-sm border border-gray-300 rounded-l-lg focus:border-main focus:ring-2 focus:ring-main/20" 
               placeholder="Cari Artikel...">
        <button type="submit" class="h-10 px-4 bg-main text-white rounded-r-lg hover:bg-main/90">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </form>
    </div>
  </div>
</div>