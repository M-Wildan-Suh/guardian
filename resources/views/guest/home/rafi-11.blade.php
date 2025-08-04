<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full overflow-x-hidden bg-background">

        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-gray-400 to-transparent"></div>
        </div>

        {{-- Artikel Populer --}}
        <section class="w-full py-20">
            <div class="max-w-4xl mx-auto px-4">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-2 h-12 bg-main rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold bg-clip-text text-second bg-second">
                        Artikel Populer
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach (array_slice($trend, 0, 4) as $item)
                    <div class="bg-white rounded-2xl hover:shadow-xl transition-all overflow-hidden relative">
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                            <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                 alt="{{ $item->judul }}"
                                 class="w-full h-56 object-cover rounded-t-2xl" />
                        </a>
                        <div class="p-5 flex flex-col justify-between h-[220px]">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h3 class="font-semibold text-xl text-gray-800 hover:text-pink-600 transition line-clamp-2">
                                    {{ $item->judul }}
                                </h3>
                            </a>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                                {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                            </p>
                            <p class="text-xs text-gray-400 mt-4 italic">{{ $item->articles->user->name ?? 'Admin' }}, {{ $item->date }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('article') }}"
                       class="inline-block px-6 py-3 text-third hover:text-white text-base bg-second rounded-full font-semibold transition">
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>
        </section>

        {{-- Artikel Terbaru --}}
        <section class="w-full bg-background py-16">
            <div class="max-w-6xl mx-auto px-4">
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
                            <div class="relative overflow-hidden rounded-2xl bg-white">
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
                            return `<span class="${className} w-2.5 h-2.5 bg-purple-500 opacity-30 hover:opacity-100 transition-opacity mx-1 rounded-full"></span>`;
                        },
                    },
                });
            });
        </script>

        <style>
            .duplicated-slide {
                background: transparent;
                border-radius: 16px;
                transition: transform 0.3s ease;
            }

            .duplicated-slide:hover {
                transform: translateY(-6px);
            }

            .swiper-slide-active {
                transform: scale(1.05);
            }

            .swiper-slide-active:hover {
                transform: scale(1.05) translateY(-6px);
            }
        </style>
    </div>
</x-layout.guest>
