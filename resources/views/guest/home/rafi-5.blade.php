<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  {{-- Banner --}}
  @php
  $randomTrend = collect($trend)->shuffle();
  @endphp
  <div class="w-full px-4 sm:px-6 lg:px-8">
    <div class="swiper homeBannerSwiper w-full py-6 mt-4">
      <div class="swiper-wrapper">
        @foreach ($randomTrend as $item)
        <div class="swiper-slide relative rounded-xl overflow-hidden">
          {{-- Gambar --}}
          <a href="{{ route('detail', ['slug' => $item->slug]) }}">
            <img src="{{ $item->banner 
                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
              alt="{{ $item->judul }}"
              class="w-full h-96 object-cover" />
          </a>

          <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-4">
            {{-- Kategori --}}
            <div class="mb-2">
              @foreach ($item->articles->articlecategory as $category)
              <a href="{{ route('category', ['category' => $category->slug]) }}"
                class="bg-main text-white hover:text-blue-500 text-sm font-semibold px-3 py-1">
                {{ $category->category }}
              </a>
              @endforeach
            </div>
            {{-- Judul --}}
            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
              class="text-white hover:text-blue-500 text-lg font-bold line-clamp-2">
              {{ Str::limit($item->judul, 80) }}
            </a>
            <div class="text-gray-200 hover:text-blue-500 text-xs mt-1">
              <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                class="font-semibold">
                {{ $item->articles->user->name }}
              </a>, {{ $item->date }}
            </div>
          </div>
        </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="swiper-pagination"></div>
    </div>
  </div>

  {{-- Artikel Terbaru --}}
  <div class="w-full max-w-[1100px] mx-auto p-4 grid grid-cols-1 md:grid-cols-4 gap-6 pb-4 mt-5">
    <div class="md:col-span-3 space-y-10 md:border-r md:border-gray-300 md:pr-6">
      <div class="grid grid-cols-1 gap-6">
        @foreach (array_slice($data, 0, 1) as $item)
        <div class="w-full mx-auto">
          <a href="{{ route('detail', ['slug' => $item->slug]) }}"
            class=" overflow-hidden flex flex-row cursor-pointer hover:shadow-2xl transition-shadow duration-300">
            <div class="relative w-1/3 overflow-hidden group">
              <img src="{{ $item->banner 
                  ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                  : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                alt="{{ $item->judul }}"
                class="w-full h-full min-h-[200px] object-cover flex-shrink-0 group-hover:scale-110 transition-transform duration-500" />

              @foreach ($item->articles->articlecategory as $category)
              <span class="absolute top-3 left-3 bg-blue-600 text-white text-xs px-2 py-1 rounded">
                {{ $category->category }}
              </span>
              @endforeach
            </div>

            <div class="w-2/3 p-6 flex flex-col justify-between">
              <div>
                <h2 class="font-bold text-xl hover:text-blue-600 duration-300 line-clamp-1 mb-3">
                  {{ $item->judul }}
                </h2>
                <p class="text-gray-600 text-sm line-clamp-2">
                  {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                </p>
              </div>
              <div class="flex items-center gap-3 text-xs text-gray-500 mt-4">
                <span class="hover:text-blue-600 font-semibold">{{ $item->articles->user->name }}</span>
                <span>{{ $item->date }}</span>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>

      {{-- Title --}}
      <div class=" w-full flex items-center gap-2 sm:gap-4">
        <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
        <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
      </div>
      <div class="grid grid-cols-1 gap-6">
        @foreach(array_slice($trend, 0, 6) as $item)
        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
          class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-row cursor-pointer hover:shadow-2xl transition-shadow duration-300">

          <img src="{{ $item->banner 
            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
            alt="{{ $item->judul }}"
            class="w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 object-cover flex-shrink-0 rounded-lg" />

          <div class="p-5 flex flex-col justify-between">
            <div>
              <p class="mt-2 font-bold text-lg hover:text-blue-600 duration-300 line-clamp-1 ">
                {{ $item->judul }}
              </p>
              <p class="text-sm sm:text-base line-clamp-2">
                {!! nl2br(Str::limit(strip_tags($item->article), 200)) !!}
              </p>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-400 mt-3">
              <span class="hover:text-blue-600 font-bold">{{ $item->articles->user->name }}</span>
              <span>{{ $item->date }}</span>
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
        <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-white space-y-3">
          <p class="text-lg font-bold">SOCIAL MEDIA</p>
          <a href="https://www.instagram.com/jasawebsite.biz/" target="_blank"
            class="flex items-center gap-3 bg-gradient-to-r from-[#f58529] via-[#dd2a7b] to-[#8134af] text-white font-semibold px-4 py-2 rounded">
            <i class="fab fa-instagram text-xl"></i>
            <span>jasawebsite.biz</span>
          </a>

          <a href="https://www.tiktok.com/@www.webz.biz" target="_blank"
            class="flex items-center gap-3 bg-black text-white font-semibold px-4 py-2 rounded">
            <i class="fab fa-tiktok text-xl"></i>
            <span>www.webz.biz</span>
          </a>

          <a href="https://wa.me/+6285798765798" target="_blank"
            class="flex items-center gap-3 bg-green-500 text-white font-semibold text-sm px-4 py-2 rounded">
            <i class="fa-brands fa-whatsapp"></i>
            <span>+62 857 9876 5798</span>
          </a>

          <a href="tel:+6285798765798" target="_blank"
            class="flex items-center gap-3 bg-green-400 text-white font-semibold text-sm px-4 py-2 rounded">
            <i class="fa-solid fa-phone"></i>
            <span>+62 857 98765 798</span>
          </a>
        </div>

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

  <style>
    .desktop-trend-pagination .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      background-color: #6B7280;
      opacity: 0.5;
      transition: all 0.3s;
      border-radius: 9999px;
    }

    .desktop-trend-pagination .swiper-pagination-bullet-active {
      width: 24px;
      background-color: #f3c623;
      opacity: 1;
    }
  </style>
  <script>
    AOS.init();

    document.addEventListener('DOMContentLoaded', function() {
      new Swiper('.homeBannerSwiper', {
        slidesPerView: 1.1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          640: {
            slidesPerView: 2
          },
          1024: {
            slidesPerView: 3
          }
        }
      });

      new Swiper(".desktopTrendSwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: ".desktop-trend-pagination",
          clickable: true,
        },
        breakpoints: {
          1024: {
            slidesPerView: 3
          },
          768: {
            slidesPerView: 2
          },
        }
      });

      let trendArticlesSwiper;

      function initMobileSwiper() {
        if (window.innerWidth < 768 && !trendArticlesSwiper) {
          trendArticlesSwiper = new Swiper(".trendArticlesSwiper", {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: true,
            autoplay: {
              delay: 3000,
              disableOnInteraction: false,
            },
            pagination: {
              el: ".trend-articles-pagination",
              clickable: true,
            },
          });
        }
      }

      function destroyMobileSwiper() {
        if (window.innerWidth >= 768 && trendArticlesSwiper) {
          trendArticlesSwiper.destroy(true, true);
          trendArticlesSwiper = undefined;
        }
      }

      if (window.innerWidth < 768) {
        initMobileSwiper();
      }

      window.addEventListener('resize', function() {
        destroyMobileSwiper();
        initMobileSwiper();
      });
    });
  </script>
</x-layout.guest>