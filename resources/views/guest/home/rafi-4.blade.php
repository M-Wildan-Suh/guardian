<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  {{-- Banner --}}
  <div class="w-full relative">
    @php
    $mainArticle = $trend[0] ?? null;
    @endphp

    @if($mainArticle)
    <div class="w-full h-[calc(50vh-40px)] sm:h-[calc(100vh-80px)] relative">
      <a href="{{ route('detail', ['slug' => $mainArticle->slug]) }}">
        <img
          src="{{ $mainArticle->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $mainArticle->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
          alt="{{ $mainArticle->judul }}"
          class="w-full h-full object-cover" />
      </a>

      <div class="w-full absolute inset-0 bg-black opacity-50 z-0"></div>
      <div class="absolute inset-0 flex flex-col justify-center items-center p-4 sm:p-6 space-y-4 max-w-[1080px] mx-auto text-center">
        <div class="relative z-10 text-white w-full flex flex-col items-center">
          {{-- Kategori --}}
          <div class="flex flex-wrap gap-2 justify-center">
            @foreach ($mainArticle->articles->articlecategory as $category)
            <a href="{{ route('category', ['category' => $category->slug]) }}"
              class=" text-white text-sm sm:text-lg font-semibold px-3 py-1 rounded-full">
              #{{ $category->category }}
            </a>
            @endforeach
          </div>

          {{-- Judul --}}
          <a href="{{ route('detail', ['slug' => $mainArticle->slug]) }}"
            class="font-bold text-xl sm:text-4xl line-clamp-1 sm:line-clamp-2 mt-4 sm:mt-6 block w-full max-w-3xl mx-auto">
            {{ Str::limit($mainArticle->judul, 120) }}
          </a>

          {{-- Deskripsi --}}
          <p class="text-sm sm:text-base line-clamp-1 sm:line-clamp-2 mt-3 sm:mt-4 w-full max-w-3xl mx-auto">
            {!! nl2br(Str::limit(strip_tags($mainArticle->article), 90)) !!}
          </p>

          {{-- Search --}}
          <div class="w-full max-w-2xl mt-6 sm:mt-8 px-4">
            <form action="{{ route('article') }}" class="w-full relative" method="get">
              <input type="text"
                name="search"
                value="{{ request('search') }}"
                class="w-full h-12 pl-6 pr-12 text-base text-black border border-gray-300 rounded-full focus:border-main focus:ring-2 focus:ring-main/20 transition-all duration-300 shadow-lg"
                placeholder="Cari Artikel...">
              <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-main">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>

  {{-- Artikel Terbaru --}}
  <div class="w-full max-w-[1100px] mx-auto p-4 grid grid-cols-1 md:grid-cols-4 gap-6 pb-4 mt-5">
    <div class="md:col-span-3 space-y-10 md:border-r md:border-gray-300 md:pr-6">
      {{-- Title --}}
      <div class=" w-full flex items-center gap-2 sm:gap-4">
        <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
        <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
      </div>
      <div class="grid grid-cols-1 gap-6">
        @foreach(array_slice($trend, 0, 4) as $item)
        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
          class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-row cursor-pointer hover:shadow-2xl transition-shadow duration-300">

          <img src="{{ $item->banner 
              ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
              : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
            alt="{{ $item->judul }}"
            class="w-24 h-24 sm:w-40 sm:h-40 object-cover flex-shrink-0" />

          <div class="p-5 flex flex-col justify-between">
            <div>
              <p class="mt-2 font-bold text-lg hover:text-blue-600 duration-300 line-clamp-1 ">
                {{ $item->judul }}
              </p>
              <p class="text-sm sm:text-base line-clamp-2">
                {!! nl2br(Str::limit(strip_tags($item->article), 200)) !!}
              </p>
            </div>
          </div>
        </a>
        @endforeach
      </div>

      {{-- Pagination --}}
      @include('components.section.pagination')
    </div>

    {{-- Popular Article --}}
    <div class="md:pl-6">
      <div class=" md:sticky top-24 space-y-4 sm:space-y-6">
        {{-- Title --}}
        <div class=" w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10">
          <div class=" w-1 h-7 bg-second rounded-full"></div>
          <p class=" text-xl font-bold text-center">Artikel Populer</p>
        </div>

        {{-- Article --}}
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4 sm:gap-8">
          @include('components.section.popular')
        </div>
      </div>
    </div>
  </div>

</x-layout.guest>