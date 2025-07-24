<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">

    <div class="w-full overflow-x-hidden">
        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

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
                        {{-- Desktop --}}
                        <div class="hidden md:block px-4">
                            <div class="swiper desktopTrendSwiper">
                                <div class="swiper-wrapper">
                                    @foreach ($trend as $item)
                                    <div class="swiper-slide mb-10">
                                        @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination desktop-trend-pagination mt-6 flex justify-center"></div>
                            </div>
                        </div>

                        {{-- Mobile --}}
                        <div class="md:hidden">
                            <div class="swiper trendArticlesSwiper px-4 mb-10">
                                <div class="swiper-wrapper">
                                    @forelse (array_slice($trend, 0, 4) as $item)
                                    <div class="swiper-slide">
                                        @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                                    </div>
                                    @empty
                                    <div class="swiper-slide w-full flex justify-center text-center">
                                        <p class="text-neutral-600">Article tidak ditemukan</p>
                                    </div>
                                    @endforelse
                                </div>
                                <div class="swiper-pagination trend-articles-pagination mt-4 flex justify-center"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Styling --}}
                    <style>
                        /* === MOBILE SWIPER === */
                        .trendArticlesSwiper .swiper-slide {
                            background: #f3f4f6;
                            border-radius: 12px;
                        }

                        .trend-articles-pagination .swiper-pagination-bullet {
                            width: 10px;
                            height: 10px;
                            opacity: 0.4;
                            background-color: #6B7280;
                            border-radius: 9999px;
                            transition: all 0.3s;
                        }

                        .trend-articles-pagination .swiper-pagination-bullet-active {
                            width: 20px;
                            opacity: 1;
                            background-color: #1D4ED8;
                        }

                        /* === DESKTOP SWIPER === */
                        .desktopTrendSwiper .swiper-slide {
                            background: #f3f4f6;
                            border-radius: 12px;
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

                    <script>
                        AOS.init();
                        document.addEventListener('DOMContentLoaded', function () {
                            // Desktop swiper
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
                                        slidesPerView: 3,
                                    },
                                    768: {
                                        slidesPerView: 2,
                                    }
                                }
                            });

                            // Mobile swiper
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

                            initMobileSwiper();
                            window.addEventListener('resize', function () {
                                destroyMobileSwiper();
                                initMobileSwiper();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>
