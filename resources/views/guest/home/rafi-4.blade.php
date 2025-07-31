<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  {{-- Banner --}}
  <div class="swiper homeBannerSwiper w-full h-[calc(50vh-40px)] sm:h-[calc(100vh-80px)]">
    <div class="swiper-wrapper">
        @foreach (array_slice($trend, 0, 4) as $item)
        <div class="swiper-slide relative w-full h-full">
            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                <img
                    src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    alt="{{ $item->judul }}"
                    class="w-full h-full object-cover"/>
            </a>

            <div class="w-full absolute inset-0 bg-black opacity-50 z-0"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-start p-4 sm:p-6 space-y-2 max-w-[1080px] mx-auto">
                
                <div class="relative z-10 text-white">
                    <div class="flex flex-wrap gap-2">
                        @foreach ($item->articles->articlecategory as $category)
                        <a href="{{ route('category', ['category' => $category->slug]) }}"
                            class="bg-white text-gray-700 text-xs px-3 py-1 rounded-full">
                            {{ $category->category }}
                        </a>
                        @endforeach
                    </div>

                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                        class="font-bold text-xl sm:text-4xl line-clamp-1 sm:line-clamp-2 mt-1 sm:mt-4">
                        {{ Str::limit($item->judul, 120) }}
                    </a>

                    <p class="text-sm sm:text-bases line-clamp-1 sm:line-clamp-2 mt-1 sm:mt-4">
                        {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                    </p>

                    <p class="text-xs sm:text-sm font-light pt-2 mt-1 sm:mt-4">
                        <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                            class="font-semibold">
                            {{ $item->articles->user->name }}
                        </a>, {{ $item->date }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="swiper-pagination banner-pagination absolute bottom-4 left-1/2 -translate-x-1/2 z-10"></div>
</div>


  {{-- Artikel Terbaru --}}
  <div class="w-full max-w-[1080px] mx-auto px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
    <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
      <div class="w-full col-span-1 md:col-span-4 space-y-4 sm:space-y-8">
        <div class="w-full flex justify-between items-center">
          <div class="w-full flex items-center gap-2 sm:gap-4">
            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
            <p class="text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          @foreach (array_slice($data, 0, 3) as $item)
          <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
          </div>
          @endforeach
        </div>

        @if (count($data) > 3)
        <div class="w-full flex justify-center mt-6">
          <a href="{{ route('article') }}">
            <button class="px-4 py-2 bg-main text-white rounded-full hover:bg-blue-900 transition duration-300">
              Lihat Lainnya
            </button>
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>

  {{-- Artikel Populer --}}
  <div class="w-full max-w-[1080px] mx-auto">
    <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
      <div class="w-full col-span-1 md:col-span-4 space-y-4 sm:space-y-8">
        <div class="w-full flex justify-between items-center">
          <div class="w-full flex items-center px-4 gap-2 sm:gap-4">
            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
            <p class="text-xl sm:text-3xl font-bold text-center">Artikel Populer</p>
          </div>
        </div>

        <div class="w-full mb-10 overflow-hidden">
          <div class="hidden md:block px-4">
            <div class="swiper desktopTrendSwiper">
              <div class="swiper-wrapper">
                @foreach ($trend as $item)
                <div class="swiper-slide p-4 mb-10">
                  @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                </div>
                @endforeach
              </div>
              <div class="desktop-trend-pagination swiper-pagination mt-6 flex justify-center"></div>
            </div>
          </div>

          <div class="md:hidden">
            <div class="swiper trendArticlesSwiper px-4 mb-10">
              <div class="swiper-wrapper">
                @forelse (array_slice($trend, 0, 4) as $item)
                <div class="swiper-slide p-4">
                  @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                </div>
                @empty
                <div class="swiper-slide w-full flex justify-center text-center">
                  <p class="text-neutral-600">Article tidak ditemukan</p>
                </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    :root {
        --bg-main: #2563EB;
        --bg-second: #64748B;
        --bg-third: #1a202c;
        --bg-light: #F9FAFB;
    }
    .swiper-slide {
      background: #f3f4f6;
      border-radius: 12px;
    }

    .swiper-pagination-bullet {
      width: 10px;
      height: 10px;
      opacity: 0.4;
      border-radius: 9999px;
      transition: all 0.3s;
      opacity: 0.20;
      background-color: var(--bg-light);
    }

    .swiper-pagination-bullet-active {
      width: 20px;
      opacity: 1;
      background-color: var(--bg-third);
    }

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
      background-color: #1D4ED8;
      opacity: 1;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    AOS.init();

    document.addEventListener('DOMContentLoaded', function() {
      new Swiper('.homeBannerSwiper', {
        loop: true,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.banner-pagination',
          clickable: true,
        },
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