<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
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
              class=" text-white text-lg font-semibold px-3 py-1 rounded-full">
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

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const swiper = new Swiper('.homeBannerSwiper', {
        loop: true,
        autoplay: {
          delay: 3500,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.banner-pagination',
          clickable: true,
        },
      });
    });
  </script>
</x-layout.guest>