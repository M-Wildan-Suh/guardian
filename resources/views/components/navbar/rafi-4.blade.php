<div x-data="{ open: false, searchOpen: false }" class="relative">
  <div class="sticky top-0 z-50 flex justify-between items-center px-6 py-4 bg-white shadow-md">
    {{-- Logo --}}
    <a href="{{ route('home') }}" class="flex items-center space-x-2">
      @php $site = json_decode(\Storage::get('website.json'), true); @endphp
      @if (($site['type'] ?? null) === 'teks')
      <p class="text-2xl sm:text-3xl font-bold text-main">{{ $site['title'] }}</p>
      @elseif (($site['type'] ?? null) === 'image')
      <img src="{{ asset('storage/images/' . $site['image']) }}" alt="" class="h-10 object-contain">
      @endif
    </a>

    <div class="flex items-center space-x-4">
      {{-- Search Icon --}}
      <button @click="searchOpen = !searchOpen" class="p-2 focus:outline-none">
        <svg class="w-7 h-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
        </svg>
      </button>

      {{-- Menu --}}
      <button @click="open = true" class="p-2 focus:outline-none">
        <svg class="w-7 h-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  {{-- Search --}}
  <div
    x-show="searchOpen"
    x-transition.opacity
    class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
    <div class="bg-white rounded-full flex w-full max-w-xl overflow-hidden">
      <input type="text"
        placeholder="Cari artikel..."
        class="flex-grow px-4 py-2 focus:outline-none text-gray-900">
      <button class="bg-main px-6 text-white">Cari</button>
    </div>
    <button @click="searchOpen = false" class="absolute top-6 right-6 text-white hover:text-gray-300">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  {{-- Fullscreen --}}
  <div
    x-show="open"
    x-transition.opacity
    class="fixed inset-0 z-50 bg-black flex flex-col items-center justify-center text-center">

    <button @click="open = false" class="absolute top-6 right-6 text-white hover:text-gray-300">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>

    {{-- Logo --}}
    <div class="mb-8">
      @if (($site['type'] ?? null) === 'teks')
      <p class="text-3xl font-bold text-white">{{ $site['title'] }}</p>
      @elseif (($site['type'] ?? null) === 'image')
      <img src="{{ asset('storage/images/' . $site['image']) }}" alt="" class="h-16 object-contain">
      @endif
    </div>

    {{-- Menu --}}
    <nav class="space-y-4">
      <a href="{{ route('home') }}"
        class="block text-lg tracking-widest hover:text-main transition text-white">
        Beranda
      </a>
      <div x-data="{ article: false }" class="relative">
      <button @click="article = !article" class="{{ request()->routeIs('article', 'article.page', 'author', 'author.page', 'category', 'category.page', 'tag', 'tag.page', 'detail') ? 'text-white bg-second' : 'text-white hover:text-main'}} w-full block text-lg tracking-widest duration-300" aria-label="Artikel">Artikel</button>
      <div x-show="article" class="max-h-36 overflow-auto py-2 flex flex-col gap-1 text-sm">
        <a href="{{route('article')}}" class="w-full text-nowrap px-4 text-white duration-300 py-1">Artikel Terbaru</a>
        @foreach ($category as $item)
        <a href="{{route('category', ['category' => $item->slug])}}" class="w-full text-nowrap px-4 text-white duration-300 py-1">{{$item->category}}</a>
        @endforeach
      </div>
    </div>
      <a href="#kontak"
        class="block text-lg tracking-widest hover:text-main transition text-white">
        Kontak
      </a>
    </nav>
  </div>
</div>