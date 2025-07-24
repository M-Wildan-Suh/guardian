<div class="w-screen relative">
  <div class="w-full" style="height: calc(100vh - 80px)">
    <div class="swiper bannerSwiper w-full h-full">
      <div class="swiper-wrapper">
        @foreach (array_slice($trend, 0, 4) as $item)
        <div class="swiper-slide relative w-full h-full">

          {{-- Banner --}}
          <a href="{{ route('detail', ['slug' => $item->slug]) }}">
            <img
              src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
              alt="{{ $item->judul }}"
              class="w-full h-full object-cover" />
          </a>

          <div class="absolute inset-0 bg-black/30 flex flex-col justify-center text-center text-white p-4 sm:p-6 space-y-2">
            <div class="flex flex-wrap gap-2 mx-auto">
              @foreach ($item->articles->articlecategory as $category)
              <a href="{{ route('category', ['category' => $category->slug]) }}"
                class="bg-white text-gray-700 text-xs px-3 py-1 rounded-full">
                {{ $category->category }}
              </a>
              @endforeach
            </div>

            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
              class="font-bold text-xl sm:text-3xl line-clamp-2">
              {{ $item->judul }}
            </a>

            <p class="text-sm sm:text-base line-clamp-2">
              {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
            </p>

            <p class="text-xs sm:text-sm font-light pt-2">
              <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}" class="font-semibold">
                {{ $item->articles->user->name }}
              </a>, {{ $item->date }}
            </p>
          </div>
        </div>
        @endforeach
      </div>

      <div class="swiper-pagination !absolute !bottom-4 left-1/2 -translate-x-1/2 z-10"></div>
    </div>
  </div>
</div>

<style>
  .bannerSwiper .swiper-pagination {
  position: absolute !important;
  bottom: 1rem !important;
  left: 50% !important;
  transform: translateX(-50%) !important;
  z-index: 10;
}

  .bannerSwiper .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    opacity: 0.4;
    background-color: #6B7280;
    border-radius: 9999px;
    transition: all 0.3s;
  }

  .bannerSwiper .swiper-pagination-bullet-active {
    width: 24px;
    opacity: 1;
    background-color: #1D4ED8;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    new Swiper(".bannerSwiper", {
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".bannerSwiper .swiper-pagination",
        clickable: true,
      },
    });
  });
</script>
