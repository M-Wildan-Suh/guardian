<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class=" w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8 bg-">
        {{-- Banner --}}
        @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
        <div class="w-full max-w-[1080px] mx-auto">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
                {{-- Main --}}
                <div class="w-full col-span-1 md:col-span-4 space-y-4 sm:space-y-8">

                    {{-- Title --}}
                    <div class="w-full flex justify-between items-center">
                        <div class="w-full flex items-center gap-2 sm:gap-4">
                            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
                            <p class="text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
                        </div>
                    </div>

                    {{-- Article --}}
                    <div class="w-full grid grid-cols-2 md:grid-cols-3 gap-4">
                        @forelse (array_slice($data, 0, 3) as $item)
                        @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                        @empty
                        <div class="col-span-2 md:col-span-3 w-full flex justify-center text-center">
                            <p class="text-neutral-600">Article tidak ditemukan</p>
                        </div>
                        @endforelse
                    </div>

                    {{-- Tombol Lihat Lainnya --}}
                    @if (count($data) > 3)
                    <div class="w-full flex justify-center mt-6">
                        <a href="{{ route('article') }}">
                            <button class="px-4 py-2 bg-main text-white rounded-full hover:bg-green-900 transition duration-300">
                                Lihat Lainnya
                            </button>
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
    </div>
    {{-- Article --}}
    <div class=" w-full max-w-[1080px] mx-auto">
        <div class=" w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
            {{-- Main --}}
            <div class=" w-full col-span-1 md:col-span-4 space-y-4 sm:space-y-8">
                {{-- Title --}}
                <div class=" w-full flex justify-between items-center">
                    <div class=" w-full flex items-center px-4 gap-2 sm:gap-4">
                        <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
                        <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Populer</p>
                    </div>
                </div>

                {{-- Article --}}
                <div class="w-full mb-10">
                    <div class="hidden md:grid md:grid-cols-4 px-4 gap-4 mb-10">
                        @forelse (array_slice($trend, 0, 4) as $item)
                        <div class="w-full">
                            @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                        </div>
                        @empty
                        <div class="col-span-4 w-full flex justify-center text-center">
                            <p class="text-neutral-600">Article tidak ditemukan</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="swiper trendArticlesSwiper md:hidden px-4 mb-10">
                        <div class="swiper-wrapper">
                            @forelse (array_slice($trend, 0, 4) as $item)
                            <div class="swiper-slide">
                                @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                            </div>
                            @empty
                            <div class="swiper-slide w-full flex justify-center text-center">
                                <p class="text-neutral-600">Article tidak ditemukan</p>
                            </div>
                            @endforelse
                        </div>

                        <div class="swiper-pagination trend-articles-pagination"></div>
                    </div>
                </div>

                <style>
                    .trend-articles-pagination .swiper-pagination-bullet {
                        width: 12px;
                        height: 12px;
                        opacity: 0.4;
                        background-color: #6B7280;
                        border-radius: 9999px;
                        transition: all 0.3s;
                    }

                    .trend-articles-pagination .swiper-pagination-bullet-active {
                        width: 24px;
                        opacity: 1;
                        background-color: #06923E;
                    }
                </style>

                <script>
                    let trendArticlesSwiper;

                    function initTrendSwiper() {
                        if (window.innerWidth < 768 && !trendArticlesSwiper) {
                            trendArticlesSwiper = new Swiper(".trendArticlesSwiper", {
                                slidesPerView: 1,
                                spaceBetween: 16,
                                centeredSlides: true,
                                loop: true,

                                autoplay: {
                                    delay: 3000,
                                    disableOnInteraction: false,
                                    pauseOnMouseEnter: true,
                                },

                                pagination: {
                                    el: ".trend-articles-pagination",
                                    clickable: true,
                                    dynamicBullets: true,
                                },

                                effect: 'slide',
                                speed: 600,

                                touchRatio: 1,
                                touchAngle: 45,
                                grabCursor: true,

                                breakpoints: {
                                    480: {
                                        slidesPerView: 1,
                                        spaceBetween: 20,
                                    },
                                    640: {
                                        slidesPerView: 1,
                                        spaceBetween: 24,
                                    },
                                },
                            });
                        }
                    }

                    function destroyTrendSwiper() {
                        if (window.innerWidth >= 768 && trendArticlesSwiper) {
                            trendArticlesSwiper.destroy(true, true);
                            trendArticlesSwiper = undefined;
                        }
                    }

                    document.addEventListener("DOMContentLoaded", () => {
                        initTrendSwiper();

                        window.addEventListener("resize", () => {
                            destroyTrendSwiper();
                            initTrendSwiper();
                        });

                        document.addEventListener("visibilitychange", () => {
                            if (trendArticlesSwiper) {
                                if (document.hidden) {
                                    trendArticlesSwiper.autoplay.stop();
                                } else {
                                    trendArticlesSwiper.autoplay.start();
                                }
                            }
                        });
                    });
                </script>
            </div>

        </div>
    </div>
    </div>
</x-layout.guest>