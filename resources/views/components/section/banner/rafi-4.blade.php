<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  {{-- Banner --}}
  <div class="w-screen relative left-1/2 -translate-x-1/2">
    <div class="swiper homeBannerSwiper w-full" style="height: calc(100vh - 80px)">
      <div class="swiper-wrapper">
        @foreach (array_slice($trend, 0, 4) as $item)
        <div class="swiper-slide relative w-full max-w-[1080px] mx-auto">
          <a href="{{ route('detail', ['slug' => $item->slug]) }}">
            <img
              src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
              alt="{{ $item->judul }}"
              class="w-full h-full object-cover" />
          </a>

          <div class="absolute inset-0 bg-black/30 flex flex-col text-white p-4 sm:p-10 space-y-2">
            <div class="flex flex-wrap gap-2">
              @foreach ($item->articles->articlecategory as $category)
              <a href="{{ route('category', ['category' => $category->slug]) }}"
                class="bg-white text-gray-700 text-xs px-3 py-1 rounded-full">
                {{ $category->category }}
              </a>
              @endforeach
            </div>

            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
              class="font-bold text-5xl sm:text-3xl line-clamp-2 text-left max-w-3xl">
              {{ $item->judul }}
            </a>

            <p class="text-base sm:text-lg line-clamp-2">
              {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
            </p>

            <p class="text-sm sm:text-base font-light pt-2">
              <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                class="font-semibold">
                {{ $item->articles->user->name }}
              </a>, {{ $item->date }}
            </p>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination banner-pagination absolute bottom-4 left-1/2 -translate-x-1/2 z-10"></div>
    </div>
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
