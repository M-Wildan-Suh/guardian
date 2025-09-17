<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full overflow-x-hidden">

        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Artikel Terbaru --}}
        <section class="w-full max-w-[1200px] mx-auto px-4 py-16">
            <div class="flex items-center gap-3 mb-8 group">
                <div class="w-2 h-10 bg-main rounded-full animate-pulse"></div>
                <h2 class="text-2xl sm:text-3xl font-bold bg-black bg-clip-text text-transparent">
                    Artikel Terbaru
                </h2>
                <div class="ml-auto hidden sm:block">
                    <a href="{{ route('article') }}" class="flex items-center gap-1 text-sm font-medium text-gray-500 hover:text-blue-700 transition-all">
                        Lihat Semua
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach (array_slice($trend, 0, 6) as $item)
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                    @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)

                    <div class="absolute bottom-4 left-0 right-0 px-4 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 z-20">
                        <a href="{{ route('detail', ['slug' => $item->slug ?? '']) }}" class="block w-full py-2 text-center text-sm font-medium bg-white text-blue-700 rounded-lg shadow-sm hover:bg-blue-50 transition-colors">
                            Baca Artikel
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            @if (count($data) > 3)
            <div class="w-full flex justify-center mt-8 sm:hidden">
                <a href="{{ route('article') }}" class="px-5 py-2.5 text-sm font-medium bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors shadow-md inline-flex items-center gap-1">
                    Lihat Lainnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
            @endif
        </section>

        {{-- Artikel Populer --}}
        <section class="w-full max-w-[1080px] mx-auto px-4 py-16">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-10 bg-main rounded-full"></div>
                <h2 class="text-2xl sm:text-3xl font-bold">Artikel Populer</h2>
            </div>
            <div class="relative mb-6">
                <div class="swiper desktopTrendSwiper mx-auto max-w-xs sm:max-w-full">
                    <div class="swiper-wrapper">
                        @foreach (array_slice($data, 0, 5) as $item)
                        <div class="swiper-slide">
                            @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.grid > div');
            cards.forEach((card, index) => {
                card.style.setProperty('--order', index);
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            new Swiper(".heroSwiper", {
                loop: true,
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".hero-banner-pagination",
                    clickable: true,
                },
            });

            new Swiper(".desktopTrendSwiper", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                },
                spaceBetween: 30,
                breakpoints: {
                    640: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                },
            });
        });
    </script>

    <style>
        .swiper-slide {
            border-radius: 12px;
        }

        @media (max-width: 640px) {
            .swiper-slide {
                box-sizing: border-box;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .grid>div {
            animation: fadeIn 0.5s ease-out forwards;
            animation-delay: calc(var(--order) * 0.1s);
        }
    </style>
</x-layout.guest>