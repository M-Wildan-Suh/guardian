<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    <div class="w-full overflow-x-hidden bg-gray-50">
        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        {{-- Artikel Populer --}}
        <section class="w-full bg-gradient-to-b from-gray-50 to-white py-16">
            <div class="max-w-[1200px] mx-auto px-4">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-12 bg-gradient-to-b from-orange-500 to-orange-600 rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-600 to-orange-800">
                        Artikel Populer
                    </h2>
                </div>

                <div class="swiper cubeSwiper w-full max-w-[300px] sm:max-w-[400px] mx-auto">
                    <div class="swiper-wrapper">
                        @foreach(array_slice($trend, 0, 4) as $item)
                        <div class="swiper-slide bg-white rounded-xl overflow-hidden shadow-lg">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4 text-black">
                                <h3 class="font-bold text-lg line-clamp-2 mb-1">{{ $item->judul }}</h3>
                                <p class="text-sm line-clamp-2">{!! nl2br(Str::limit(strip_tags($item->article), 80)) !!}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $item->articles->user->name ?? '' }}, {{ $item->date }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-4 !relative"></div>
                </div>
            </div>
        </section>

        {{-- Artikel Terbaru --}}
        <section class="w-full bg-gradient-to-b from-gray-100 to-white py-16">
            <div class="w-full max-w-[1200px] mx-auto px-4">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-12 bg-gradient-to-b from-blue-500 to-blue-600 rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">
                        Artikel Terbaru
                    </h2>
                </div>

                <div class="swiper duplicatedTrendSwiper pb-12">
                    <div class="swiper-wrapper">
                        @foreach (array_slice($data, 0, 6) as $item)
                        <div class="swiper-slide duplicated-slide max-w-xs px-4">
                            <div class="relative overflow-hidden rounded-xl shadow-lg h-full">
                                @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination duplicated-trend-pagination mt-4 flex justify-center gap-2"></div>
                </div>
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

            .cubeSwiper {
                height: 400px;
            }
        </style>
    </div>
</x-layout.guest>