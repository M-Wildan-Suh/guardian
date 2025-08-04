<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    <div class="w-full overflow-x-hidden bg-background">
        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        {{-- Artikel Populer --}}
        <section class="w-full bg-background py-6 md:py-8">
            <div class="max-w-[1080px] mx-auto px-3 sm:px-4">
                <div class="flex items-center gap-2 mb-4 sm:mb-6">
                    <div class="w-1.5 h-8 sm:h-10 bg-second rounded-full"></div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold bg-clip-text text-transparent bg-main">
                        Artikel Populer
                    </h2>
                </div>

                <div class="swiper cubeSwiper w-full max-w-[400px] sm:max-w-[500px] mx-auto !pb-8">
                    <div class="swiper-wrapper !items-stretch">
                        @foreach(array_slice($trend, 0, 4) as $item)
                        <div class="swiper-slide bg-white rounded-xl overflow-hidden shadow-lg flex flex-col h-full !self-stretch">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="block aspect-[5/3] overflow-hidden">
                                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    alt="{{ $item->judul }}"
                                    class="w-full h-full object-cover">
                            </a>

                            <div class="p-4 sm:p-4 flex flex-col flex-1 gap-1 sm:gap-1.5">
                                <h3 class="font-bold text-sm sm:text-base line-clamp-2 leading-tight">{{ $item->judul }}</h3>
                                <p class="text-xs sm:text-sm line-clamp-2 text-gray-600 flex-grow mt-2">{!! nl2br(Str::limit(strip_tags($item->article), 70)) !!}</p>
                                <p class="text-[10px] sm:text-xs text-gray-400 mt-auto">{{ $item->articles->user->name ?? '' }}, {{ $item->date }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination !bottom-0"></div>
                </div>
            </div>
        </section>


        {{-- Artikel Terbaru --}}
        <section class="w-full bg-background py-12 md:py-16 lg:py-20">
            <div class="w-full max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3 mb-8 md:mb-12">
                    <div class="w-2 h-12 bg-main rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold bg-clip-text text-transparent bg-main">
                        Artikel Terbaru
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach (array_slice($data, 0, 3) as $item)
                    <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">
                        @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                    </div>
                    @endforeach
                </div>

                @if (count($data) > 3)
                <div class="w-full flex justify-center mt-10 md:mt-12">
                    <a href="{{ route('article') }}" class="inline-block">
                        <button class="px-6 py-3 text-base font-semibold bg-main text-white rounded-full hover:bg-blue-900 transition duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                            Lihat Lainnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </a>
                </div>
                @endif
            </div>
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

                new Swiper(".cubeSwiper", {
                    effect: "cube",
                    grabCursor: true,
                    loop: true,
                    keyboard: {
                        enabled: true,
                        onlyInViewport: true, // opsional
                    },
                    autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    },
                    cubeEffect: {
                        shadow: true,
                        slideShadows: true,
                        shadowOffset: 20,
                        shadowScale: 0.94,
                    },
                    pagination: {
                        el: ".cubeSwiper .swiper-pagination",
                        clickable: true,
                    },
                });

                new Swiper(".duplicatedTrendSwiper", {
                    effect: "coverflow",
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: "auto",
                    loop: true,
                    spaceBetween: 30,
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 0,
                        depth: 100,
                        modifier: 2,
                        slideShadows: false,
                    },
                    pagination: {
                        el: ".duplicated-trend-pagination",
                        clickable: true,
                        renderBullet: function(index, className) {
                            return `<span class="${className} w-2.5 h-2.5 bg-blue-500 opacity-30 hover:opacity-100 transition-opacity mx-1 rounded-full"></span>`;
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
            .duplicated-slide {
                background: transparent;
                border-radius: 12px;
                transition: transform 0.3s ease;
            }

            .duplicated-slide:hover {
                transform: translateY(-5px);
            }

            .swiper-slide-active {
                transform: scale(1.05);
            }

            .swiper-slide-active:hover {
                transform: scale(1.05) translateY(-5px);
            }
        </style>
    </div>
</x-layout.guest>