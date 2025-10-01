<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    <div class="w-full overflow-x-hidden bg-gray-50">
        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        {{-- Artikel Populer --}}
        <section class="w-full bg-background py-16">
            <div class="max-w-[1200px] mx-auto px-4">
                {{-- Header --}}
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-2 h-12 bg-main rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold bg-clip-text text-second">
                        Artikel Populer
                    </h2>
                </div>

                {{-- Artikel populer --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach (array_slice($trend, 0, 4) as $item)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all overflow-hidden flex flex-col">
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                            <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-48 object-cover" />
                        </a>
                        <div class="p-4 flex flex-col justify-between flex-grow">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h3 class="font-semibold text-lg text-gray-800 hover:text-blue-600 transition line-clamp-2">
                                    {{ $item->judul }}
                                </h3>
                            </a>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                                {!! nl2br(Str::limit(strip_tags($item->article), 90)) !!}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Artikel Terbaru --}}
        <section class="w-full bg-gradient-to-b from-gray-100 to-white py-10">
            <div class="w-full max-w-[1200px] mx-auto px-4">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-12 bg-main rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold bg-clip-text text-transparent bg-second">
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
                    {{-- Tombol --}}
                    <div class="text-center mt-12">
                        <a href="{{ route('article') }}"
                            class="inline-block px-6 py-3 text-white bg-second text-base rounded-full font-semibold transition">
                            Lihat Semua
                        </a>
                    </div>
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

                new Swiper(".popularTrendSwiper", {
                    grabCursor: true,
                    loop: true,
                    spaceBetween: 20,
                    slidesPerView: 1.2,
                    centeredSlides: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2.2
                        },
                        1024: {
                            slidesPerView: 3
                        }
                    },
                    pagination: {
                        el: ".popular-trend-pagination",
                        clickable: true,
                        renderBullet: function(index, className) {
                            return `<span class="${className} w-2.5 h-2.5 bg-orange-500 opacity-30 hover:opacity-100 transition-opacity mx-1 rounded-full"></span>`;
                        },
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

            .popular-slide {
                transition: transform 0.3s ease;
            }

            .popular-slide:hover {
                transform: translateY(-5px);
            }

            .swiper-slide-active:hover {
                transform: scale(1.05) translateY(-5px);
            }
        </style>
    </div>
</x-layout.guest>