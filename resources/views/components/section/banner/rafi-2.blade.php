<div class="w-full max-w-[1080px] mx-auto">
  <div class="w-full">
    <div class="swiper mySwiper w-full max-w-5xl mx-auto rounded-lg overflow-hidden shadow-md">
      <div class="swiper-wrapper">
        @foreach (array_slice($trend, 0, 4) as $item)
        <div class="swiper-slide relative w-full  h-[240px] sm:h-[300px] md:h-[400px] ">

          {{-- Banner --}}
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
              <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}" class="font-semibold">
                {{ $item->articles->user->name }}
              </a>, {{ $item->date }}
            </p>
          </div>
        </div>
        @endforeach

      </div>

      <div class="swiper-pagination mt-4"></div>
    </div>


  </div>

  <style>
    .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      opacity: 0.4;
      background-color: #6B7280;
      border-radius: 9999px;
      transition: all 0.3s;
    }

    .swiper-pagination-bullet-active {
      width: 24px;
      opacity: 1;
      background-color: #06923E;
    }
  </style>



  <script>
    document.addEventListener("DOMContentLoaded", () => {
      new Swiper(".mySwiper", {
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    });
  </script>

</div>