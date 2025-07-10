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
                            <button class="px-4 py-2 bg-main text-white rounded-full hover:bg-blue-900 transition duration-300">
                                Lihat Lainnya
                            </button>
                        </a>
                    </div>
                    @endif

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

                    {{-- Article Trending --}}
                    <div class="w-full mb-10 overflow-hidden">
                        {{-- Desktop Version (Auto-scrolling Marquee) --}}
                        <div class="hidden md:block relative">
                            <div class="py-6">
                                <div class="marquee-container whitespace-nowrap">
                                    <div class="marquee-content inline-flex gap-6">
                                        <!-- Duplicate items untuk efek seamless looping -->
                                        @foreach(array_merge($trend, $trend) as $item)
                                        <div class="inline-block w-[300px]">
                        @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile Version (Swiper) --}}
                        <div class="md:hidden">
                            <div class="swiper trendArticlesSwiper px-4 mb-10">
                                <!-- Tetap gunakan swiper untuk mobile -->
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
                    </div>

                    <style>
                        .marquee-container {
                            overflow: hidden;
                            position: relative;
                        }

                        .marquee-content {
                            animation: marquee 30s linear infinite;
                            will-change: transform;
                        }

                        @keyframes marquee {
                            0% {
                                transform: translateX(0);
                            }

                            100% {
                                transform: translateX(-50%);
                            }
                        }

                        .marquee-container:hover .marquee-content {
                            animation-play-state: paused;
                        }

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
                            background-color: #1D4ED8;
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            
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

                            document.addEventListener('visibilitychange', function() {
                                if (trendArticlesSwiper) {
                                    if (document.hidden) {
                                        trendArticlesSwiper.autoplay.stop();
                                    } else {
                                        trendArticlesSwiper.autoplay.start();
                                    }
                                }
                            });

                            const marqueeContent = document.querySelector('.marquee-content');
                            if (marqueeContent) {
                                const marqueeItems = marqueeContent.querySelectorAll('div');
                                const itemWidth = marqueeItems[0]?.offsetWidth || 300;
                                const gap = 24; // Sesuaikan dengan gap yang digunakan
                                const totalWidth = (itemWidth + gap) * marqueeItems.length;
                                const duration = totalWidth / 50; // Kecepatan scroll (pixel per second)

                                document.documentElement.style.setProperty(
                                    '--marquee-duration',
                                    `${duration}s`
                                );

                                const styleSheet = document.styleSheets[0];
                                styleSheet.insertRule(`
                @keyframes marquee {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-${totalWidth / 2}px); }
                }
            `, styleSheet.cssRules.length);
                            }
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>
</x-layout.guest>