<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<div class="w-screen relative left-1/2 -translate-x-1/2">
  <div class="swiper mySwiper w-full" style="height: calc(100vh - 80px)">
    <div class="swiper-wrapper">
      @foreach (array_slice($trend, 0, 4) as $item)
      <div class="swiper-slide relative w-full h-full">
        <a href="{{ route('detail', ['slug' => $item->slug]) }}">
          <img
            src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
            alt="{{ $item->judul }}"
            class="w-full h-full object-cover" />
        </a>

        <div class="absolute inset-0 bg-black/30 flex flex-col justify-end text-white p-4 sm:p-6 space-y-2">
          <div class="flex flex-wrap gap-2">
            @foreach ($item->articles->articlecategory as $category)
            <a href="{{ route('category', ['category' => $category->slug]) }}"
              class="bg-white text-gray-700 text-xs px-3 py-1 rounded-full">
              {{ $category->category }}
            </a>
            @endforeach
          </div>

          <a href="{{ route('detail', ['slug' => $item->slug]) }}"
            class="font-bold text-xl sm:text-2xl line-clamp-2">
            {{ $item->judul }}
          </a>

          <p class="text-sm sm:text-base line-clamp-2">
            {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
          </p>

          <p class="text-xs sm:text-sm font-light pt-2">
            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
              class="font-semibold">
              {{ $item->articles->user->name }}
            </a>, {{ $item->date }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
    <div class="swiper-pagination mt-4 hidden md:flex justify-center"></div>
  </div>
</div>

<script>
  const swiper = new Swiper('.mySwiper', {
    loop: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    slidesPerView: 1,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>
