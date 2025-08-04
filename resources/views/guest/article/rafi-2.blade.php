<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8 bg-white">
        {{-- Banner --}}
        @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

        {{-- Article Terbaru --}}
        <div class="w-full max-w-[1080px] mx-auto">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
                <div class="w-full col-span-1 md:col-span-4 space-y-4 sm:space-y-8">
                    {{-- Title --}}
                    <div class="w-full flex justify-between items-center">
                        <div class="w-full flex items-center gap-2 sm:gap-4">
                            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
                            <p class="text-xl sm:text-3xl font-bold">Artikel Terbaru</p>
                        </div>
                    </div>

                    {{-- Article --}}
                    <div class="relative">
                        <div class="w-full grid grid-cols-2 md:grid-cols-3 gap-4">
                            @forelse (array_slice($data, 0, 3) as $item)
                            @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                            @empty
                            <div class="col-span-2 md:col-span-3 w-full flex justify-center text-center">
                                <p class="text-neutral-600">Article tidak ditemukan</p>
                            </div>
                            @endforelse

                            {{-- Lihat Lainnya --}}
                            @if (count($data) > 3)
                            <div class="md:hidden col-span-1 flex items-center justify-center">
                                <a href="{{ route('article') }}" class="group">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 bg-main rounded-full flex items-center justify-center shadow-lg group-hover:bg-green-900 transition-all duration-300">
                                            <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white">
                                                <path fill="none" d="M0 0h256v256H0z"></path>
                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="24" d="m96 48 80 80-80 80"></path>
                                            </svg>
                                        </div>
                                        <span class="text-xs mt-1 text-main group-hover:text-green-900 transition-colors duration-300">Lihat Lainnya</span>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>

                        {{-- Desktop Button --}}
                        @if (count($data) > 3)
                        <div class="hidden md:flex justify-center mt-6">
                            <a href="{{ route('article') }}">
                                <button class="px-4 py-2 bg-main text-white rounded-full hover:bg-green-900 transition duration-300 text-sm sm:text-base whitespace-nowrap flex items-center gap-1">
                                    Lihat Lainnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Artikel Populer --}}
        <div class="w-full max-w-[1080px] mx-auto bg-white">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
                <div class="w-full col-span-1 md:col-span-4 space-y-4 sm:space-y-8">
                    {{-- Title --}}
                    <div class="w-full flex justify-between items-center px-4">
                        <div class="w-full flex items-center gap-2 sm:gap-4">
                            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
                            <p class="text-xl sm:text-3xl font-bold">Artikel Populer</p>
                        </div>
                    </div>

                    <div class="hidden md:grid md:grid-cols-4 px-4 gap-4">
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

                    {{-- Mobile Swiper --}}
                    <div class="swiper trendArticlesSwiper md:hidden">
                        <div class="swiper-wrapper px-4">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .banner-pagination .swiper-pagination {
            right: 1rem;
            left: auto;
            width: auto;
            display: flex;
            justify-content: flex-end;
            padding-right: 1rem;
            bottom: 1rem !important;
            top: auto !important;
        }

        /* Floating Button Animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating-btn {
            animation: float 3s ease-in-out infinite;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (document.querySelector('.banner-swiper')) {
                new Swiper('.banner-swiper', {
                    pagination: {
                        el: '.banner-pagination',
                        clickable: true,
                    },
                });
            }

            let trendArticlesSwiper;

            function initTrendSwiper() {
                if (window.innerWidth < 768 && !trendArticlesSwiper) {
                    trendArticlesSwiper = new Swiper(".trendArticlesSwiper", {
                        slidesPerView: 1.2,
                        spaceBetween: 16,
                        centeredSlides: false,
                        loop: true,
                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: ".trend-articles-pagination",
                            clickable: true,
                            dynamicBullets: true,
                        },
                        breakpoints: {
                            480: {
                                slidesPerView: 1.5
                            },
                            640: {
                                slidesPerView: 2
                            }
                        },
                    });
                }
            }

            initTrendSwiper();
            window.addEventListener("resize", initTrendSwiper);
        });
    </script>
</x-layout.guest>