<div 
  class="fixed top-0 left-0 w-full z-40 bg-main backdrop-blur-md transition-all duration-300"
  x-data="{ show: false, open: false, article: false }">

  <div class="max-w-[1080px] mx-auto px-4 md:px-8 py-4">
    {{-- Navigation --}}
    <div class="flex items-center justify-between">
      
      {{-- Logo --}}
      <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
        <div class="h-10 sm:h-12 flex items-center overflow-hidden">
          @php $site = json_decode(\Storage::get('website.json'), true); @endphp
          @if (($site['type'] ?? null) === 'teks')
          <p class="text-2xl sm:text-3xl font-bold text-white hover:text-second transition-colors">
            {{ $site['title'] }}
          </p>
          @elseif (($site['type'] ?? null) === 'image')
          <img src="{{ asset('storage/images/' . $site['image']) }}" alt="" class="max-h-full max-w-full object-contain">
          @endif
        </div>
      </a>

      {{-- Desktop --}}
      <div class="hidden md:flex items-center space-x-1 ml-auto mr-8">
        
        {{-- Navigasi --}}
        <div class="flex items-center space-x-1 bg-gray-50 rounded-full p-1 shadow-inner">
          <a href="{{ route('home') }}"
            class="px-5 py-2.5 text-sm font-semibold rounded-full transition-all duration-300
                    {{ request()->routeIs('home') ? ' text-main shadow-md' : 'text-gray-600 hover:text-main hover:bg-gray-50' }}">
            Beranda
          </a>

          {{-- Artikel Dropdown --}}
          <div x-data="{ articleOpen: false }" class="relative">
            <button
              @mouseenter="articleOpen = true"
              @mouseleave="articleOpen = false"
              class="px-5 py-2.5 text-sm font-semibold rounded-full transition-all duration-300 flex items-center space-x-1
                      {{ request()->routeIs('article*', 'category*', 'tag*', 'detail') ? 'bg-white text-main ' : 'text-gray-600 hover:text-main hover:bg-white hover:shadow-md' }}">
              <span>Artikel</span>
              <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': articleOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            {{-- Dropdown Menu --}}
            <div x-show="articleOpen"
              @mouseenter="articleOpen = true"
              @mouseleave="articleOpen = false"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 translate-y-2"
              x-transition:enter-end="opacity-100 translate-y-0"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100 translate-y-0"
              x-transition:leave-end="opacity-0 translate-y-2"
              class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-300 z-50 overflow-hidden">
              <div class="py-2">
                <a href="{{ route('article') }}"
                  class="block px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-main/5 hover:text-main transition-colors
                         {{ request()->routeIs('article') ? 'bg-main/10 text-main' : '' }}">
                  <span class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Artikel Terbaru
                  </span>
                </a>
                @foreach ($category as $item)
                <a href="{{ route('category', ['category' => $item->slug]) }}"
                  class="flex px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-main/5 hover:text-main transition-colors
                        {{ request()->is('category/'.$item->slug) ? 'bg-main/10 text-main' : '' }}">
                         <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                  {{ $item->category }}
                </a>
                @endforeach
              </div>
            </div>
          </div>

          <a href="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak"
            class="px-5 py-2.5 text-sm font-semibold rounded-full transition-all duration-300
                    {{ request()->is('*#kontak') ? 'bg-white text-main ' : 'text-gray-600 hover:text-main hover:bg-white hover:shadow-md' }}">
            Kontak
          </a>
        </div>
      </div>

      {{-- Search --}}
      <div class="hidden md:flex items-center">
        <form action="{{ route('article') }}" method="get" class="relative">
          <div class="relative flex items-center bg-white border border-gray-200 rounded-full shadow-sm hover:shadow-md transition-shadow">
            <svg class="w-4 h-4 ml-4 text-gray-400 absolute left-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
              type="text"
              name="search"
              value="{{ request('search') }}"
              class="w-64 pl-10 pr-4 py-2.5 text-sm bg-transparent border-0 rounded-full focus:ring-2 focus:ring-main/20 focus:outline-none"
              placeholder="Cari artikel..."
            />
            <button
              type="submit"
              class="px-4 py-2.5 text-sm font-semibold text-main rounded-r-full transition-colors">
              Cari
            </button>
          </div>
        </form>
      </div>

      {{-- Mobile Menu Button --}}
      <button @click="open = !open" class="md:hidden p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>

  {{-- Mobile Menu --}}
  <div x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    class="md:hidden bg-white border-t border-gray-200 shadow-xl">
    
    <div class="px-4 py-4 space-y-3">
      {{-- Navigation Links --}}
      <a href="{{ route('home') }}"
        class="flex items-center px-4 py-3 text-lg font-medium rounded-xl bg-white hover:bg-main transition-colors
               {{ request()->routeIs('home') ? 'text-main bg-main/10' : 'text-gray-700' }}">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Beranda
      </a>

      {{-- Artikel Dropdown --}}
      <div class="space-y-2">
        <button @click="article = !article"
          class="w-full flex items-center justify-between px-4 py-3 text-lg font-medium rounded-xl bg-gray-50 hover:bg-main/5 transition-colors
                 {{ request()->routeIs('article*', 'category*', 'tag*', 'detail') ? 'text-main bg-main/10' : 'text-gray-700' }}">
          <span class="flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            Artikel
          </span>
          <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': article }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <div x-show="article" class="pl-12 space-y-2">
          <a href="{{ route('article') }}"
            class="block px-4 py-2 text-base rounded-lg hover:bg-main/5 transition-colors
                   {{ request()->routeIs('article') ? 'text-main bg-main/10' : 'text-gray-600' }}">
            Artikel Terbaru
          </a>
          @foreach ($category as $item)
          <a href="{{ route('category', ['category' => $item->slug]) }}"
            class="block px-4 py-2 text-base rounded-lg hover:bg-main/5 transition-colors
                   {{ request()->is('category/'.$item->slug) ? 'text-main bg-main/10' : 'text-gray-600' }}">
            {{ $item->category }}
          </a>
          @endforeach
        </div>
      </div>

      <a href="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak"
        class="flex items-center px-4 py-3 text-lg font-medium rounded-xl bg-gray-50 hover:bg-main/5 transition-colors
               {{ request()->is('*#kontak') ? 'text-main bg-main/10' : 'text-gray-700' }}">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        Kontak
      </a>
    </div>

    {{-- Mobile Search --}}
    <div class="px-4 py-4 border-t border-gray-200">
      <form action="{{ route('article') }}" method="get" class="flex space-x-2">
        <div class="flex-1 relative">
          <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-main/20 focus:border-transparent"
            placeholder="Cari artikel..."
          />
        </div>
        <button
          type="submit"
          class="px-4 py-2.5 bg-main text-white rounded-lg hover:bg-main/90 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </form>
    </div>
  </div>
</div>