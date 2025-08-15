<div class="w-screen relative">
  <div class="w-full h-screen sm:h-screen">
    <div class="swiper heroBannerSwiper w-full h-full">
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

          <div class="absolute inset-0 bg-black/40 flex flex-col justify-center text-center text-white space-y-2 px-4">
            <div class="flex flex-wrap justify-center gap-2">
              @foreach ($item->articles->articlecategory as $category)
              <a href="{{ route('category', ['category' => $category->slug]) }}"
                class="inline-block bg-white/90 hover:bg-white text-gray-800 hover:text-main-dark text-xs font-medium px-3 py-1 rounded-full transition-all duration-200 ease-in-out shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
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

      <div class="hero-banner-pagination swiper-pagination"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    new Swiper(".heroBannerSwiper", {
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".hero-banner-pagination",
        clickable: true,
      },
    });
  });
</script>
