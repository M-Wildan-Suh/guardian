<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    <div class="w-full overflow-x-hidden bg-gray-50">
        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        {{-- Artikel --}}
        <section class="w-full bg-gradient-to-b from-gray-50 to-white py-16">
            <div class="w-full max-w-[1200px] mx-auto px-4">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-12 bg-gradient-to-b from-orange-500 to-orange-600 rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-600 to-orange-800">
                        Artikel Populer
                    </h2>
                </div>

                <div class="swiper desktopTrendSwiper pb-12">
                    <div class="swiper-wrapper">
                        @foreach ($trend as $item)
                        <div class="swiper-slide max-w-xs px-4">
                            <div class="relative overflow-hidden rounded-xl shadow-lg h-full">
                                @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination desktop-trend-pagination mt-4 flex justify-center gap-2"></div>
                </div>
            </div>
        </section>

        {{-- Artikel --}}
        <section class="w-full max-w-[1200px] mx-auto px-4 py-16">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-2 h-12 bg-gradient-to-b from-blue-500 to-blue-600 rounded-full"></div>
                <h2 class="text-3xl sm:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">
                    Artikel Terbaru
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach (array_slice($data, 0, 3) as $item)
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-blue-700/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                </div>
                @endforeach
            </div>

            @if (count($data) > 3)
            <div class="w-full flex justify-center mt-12">
                <a href="{{ route('article') }}" class="relative inline-flex items-center px-8 py-3 overflow-hidden text-white bg-blue-600 rounded-full group">
                    <span class="absolute right-0 transition-all duration-300 w-8 h-8 -mt-2 rounded-full bg-blue-700 group-hover:w-full group-hover:-right-4"></span>
                    <span class="relative flex items-center gap-2 text-sm font-medium transition-all duration-300 group-hover:translate-x-2">
                        Lihat Semua Artikel
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </a>
            </div>
            @endif
        </section>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                new Swiper(".heroSwiper", {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".hero-banner-pagination",
                        clickable: true,
                        renderBullet: function(index, className) {
                            return `<span class="${className} w-3 h-3 bg-white opacity-50 hover:opacity-100 transition-opacity mx-1 rounded-full"></span>`;
                        },
                    },
                });

                new Swiper(".desktopTrendSwiper", {
                    effect: "coverflow",
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: "auto",
                    loop: true,
                    spaceBetween: 30,
                    keyboard: {
                        enabled: true,
                        onlyInViewport: true,
                    },
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 0,
                        depth: 100,
                        modifier: 2,
                        slideShadows: false,
                    },
                    pagination: {
                        el: ".desktop-trend-pagination",
                        clickable: true,
                        renderBullet: function(index, className) {
                            return `<span class="${className} w-2.5 h-2.5 bg-orange-500 opacity-30 hover:opacity-100 transition-opacity mx-1 rounded-full"></span>`;
                        },
                    },
                    breakpoints: {
                        640: {
                            coverflowEffect: {
                                rotate: 5,
                                stretch: 10,
                            }
                        }
                    }
                });
            });
        </script>

        <style>
            .swiper-slide {
                background: transparent;
                border-radius: 12px;
                transition: transform 0.3s ease;
            }

            .swiper-slide:hover {
                transform: translateY(-5px);
            }

            .swiper-slide-active {
                transform: scale(1.05);
            }

            .swiper-slide-active:hover {
                transform: scale(1.05) translateY(-5px);
            }

            .hero-banner {
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }
        </style>
    </div>
</x-layout.guest>