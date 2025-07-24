<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full overflow-x-hidden bg-background">

        {{-- Banner Slider --}}
        <section class="w-full">
            <div class="max-w-6xl mx-auto relative py-6 sm:py-12">
                <div class="swiper bannerSlider relative w-full h-80 sm:h-[400px] rounded-xl overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach (array_slice($trend, 0, 4) as $item)
                        <div class="swiper-slide relative w-full h-full">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    alt="{{ $item->judul }}"
                                    class="w-full h-full object-cover" />
                            </a>
                            <div class="absolute inset-0 bg-black/40 flex flex-col justify-end p-6 text-white">
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach ($item->articles->articlecategory as $category)
                                    <a href="{{ route('category', ['category' => $category->slug]) }}"
                                        class="text-xs px-3 py-1 rounded-full bg-white text-gray-800 font-semibold">
                                        {{ $category->category }}
                                    </a>
                                    @endforeach
                                </div>
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <h2 class="text-xl sm:text-3xl font-bold line-clamp-2 hover:underline">
                                        {{ $item->judul }}
                                    </h2>
                                </a>
                                <p class="text-sm mt-2 line-clamp-2">
                                    {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                                </p>
                                <p class="text-xs mt-2 font-light italic">
                                    {{ $item->articles->user->name ?? 'Admin' }}, {{ $item->date }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-4"></div>
                </div>
            </div>
        </section>

        {{-- Artikel Populer --}}
        <section class="w-full py-20">
            <div class="max-w-5xl mx-auto px-4">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-2 h-12 bg-main rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-main">
                        Artikel Populer
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach (array_slice($trend, 0, 4) as $item)
                    <div class="bg-white rounded-3xl border border-main/20 hover:shadow-2xl transition-all overflow-hidden relative group">
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                            <div class="relative overflow-hidden">
                                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    alt="{{ $item->judul }}"
                                    class="w-full h-56 object-cover transition-transform duration-700 group-hover:scale-105" />
                                <div class="absolute inset-0 bg-black/30 z-10"></div>
                                <div class="absolute top-4 left-4 bg-main text-white text-xs font-bold px-3 py-1 rounded-full shadow-md z-20">
                                    Trending
                                </div>
                            </div>
                        </a>
                        <div class="p-5 relative z-10">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h3 class="font-bold text-xl text-gray-800 group-hover:text-main transition line-clamp-2">
                                    {{ $item->judul }}
                                </h3>
                            </a>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                                {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                            </p>
                            <p class="text-xs text-gray-400 mt-4 italic">
                                {{ $item->articles->user->name ?? 'Admin' }}, {{ $item->date }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </section>

        {{-- Artikel Terbaru --}}
        <section class="w-full py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center gap-3 mb-12">
            <div class="w-2 h-12 bg-main rounded-full"></div>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-main">
                Artikel Terbaru
            </h2>
        </div>

        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (array_slice($data, 0, 6) as $item)
            <div class="bg-white border border-main/20 rounded-2xl shadow hover:shadow-xl transition-all overflow-hidden group flex flex-col">
                <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="block overflow-hidden">
                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}" alt="{{ $item->judul }}" class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-105">
                </a>
                <div class="p-5 flex flex-col flex-grow">
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-main line-clamp-2">
                            {{ $item->judul }}
                        </h3>
                    </a>
                    <p class="text-sm text-gray-600 mt-2 line-clamp-3 flex-grow">
                        {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                    </p>
                    <div class="mt-4 text-xs text-gray-500 flex items-center justify-between">
                        <span class="italic">{{ $item->articles->user->name ?? 'Admin' }}</span>
                        <span>{{ $item->date }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-14">
            <a href="{{ route('article') }}" class="inline-block px-7 py-3 bg-main text-white rounded-full font-semibold hover:opacity-90 transition">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>


        <script>
            document.addEventListener("DOMContentLoaded", () => {
                new Swiper(".bannerSlider", {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    effect: "fade",
                    fadeEffect: {
                        crossFade: true
                    }
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
                            return `<span class="${className} w-2.5 h-2.5 bg-main opacity-30 hover:opacity-100 transition-opacity mx-1 rounded-full"></span>`;
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

            .group:hover .group-hover\:scale-105 {
                transform: scale(1.05);
            }
        </style>
    </div>
</x-layout.guest>