<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full overflow-x-hidden bg-background">

        <div class="bg-main text-white py-3 overflow-hidden relative">
            <div class="absolute left-0 top-0 h-full bg-red-600 px-4 flex items-center font-bold z-20">
                Breaking News
            </div>
            <div class="ml-40 text-base font-semibold whitespace-nowrap animate-marquee">
                @foreach (array_slice($trend, 0, 10) as $item)
                <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="mx-6 hover:underline">
                    {{ $item->judul }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- Banner Slider --}}
        <section class="w-full">
            <div class="max-w-6xl mx-auto relative py-6 sm:py-12">
                <div class="swiper bannerSlider relative w-full h-80 sm:h-[400px] rounded-sm overflow-hidden">
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
        <section class="w-full py-10">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-center gap-3 mb-12">
                    <div class="w-2 h-12 bg-main rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-main">
                        Artikel Terbaru
                    </h2>
                </div>

                <div class="grid gap-8 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        @if (isset($data[0]))
                        @php $item = $data[0]; @endphp
                        <div class="bg-white border border-main/20 rounded-2xl shadow hover:shadow-xl transition overflow-hidden">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    alt="{{ $item->judul }}"
                                    class="w-full h-80 object-cover">
                            </a>
                            <div class="p-5">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <h3 class="text-2xl font-bold text-gray-800 hover:text-main transition line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>
                                </a>
                                <div class="text-xs text-gray-500 mt-2 flex items-center gap-3">
                                    <span>{{ $item->date }}</span>
                                    <span>|</span>
                                    <span>{{ $item->articles->user->name ?? 'Admin' }}</span>
                                </div>
                                <p class="mt-3 text-sm text-gray-600">
                                    {!! nl2br(Str::limit(strip_tags($item->article), 150)) !!}
                                </p>
                            </div>
                        </div>
                        @endif

                        <div class="w-full max-w-[1080px] mx-auto bg-white rounded-xl shadow-md p-4 sm:p-6 mt-4">

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                @foreach(array_slice($trend, 0, 3) as $item)
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="group">
                                    <div class="p-3 border border-gray-200 rounded-lg transition-colors h-full">
                                    <div class="flex gap-3">
                                    <img src="{{ $item->banner 
                                            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                            alt="{{ $item->judul }}"
                                            class="w-20 h-20 object-cover flex-shrink-0 left-3 rounded" />
                                        <h3 class="font-bold text-lg group-hover:text-blue-600 line-clamp-1">
                                            {{ $item->judul }}
                                        </h3>
                                        
                                    </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Section Samping --}}
                    <div class="space-y-5 border-t pt-5">
                        @foreach (array_slice($trend, 1, 5) as $item)
                        <div class="flex gap-4 border-b pb-4">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="flex-shrink-0">
                                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    alt="{{ $item->judul }}"
                                    class="w-24 h-20 object-cover rounded">
                            </a>
                            <div class="flex flex-col justify-between">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <h4 class="text-sm font-semibold text-gray-800 hover:text-main line-clamp-2">
                                        {{ $item->judul }}
                                    </h4>
                                </a>
                                <p class="mt-3 text-sm text-gray-600 line-clamp-1">
                                    {!! nl2br(Str::limit(strip_tags($item->article), 90)) !!}
                                </p>
                                <div class="text-xs text-gray-500">
                                    {{ $item->date }} | {{ $item->articles->user->name}}
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="p-4">
                            <h2 class="text-xl sm:text-2xl font-bold mb-3 text-main underline">Ikuti Kami :</h2>
                            <div class="flex gap-3">
                                <a href="https://www.instagram.com/jasawebsite.biz/" target="_blank"
                                    class="w-12 h-12 flex items-center justify-center rounded bg-gradient-to-r from-[#f58529] via-[#dd2a7b] to-[#8134af] text-white text-3xl">
                                    <i class="fab fa-instagram"></i>
                                </a>

                                <a href="https://www.tiktok.com/@www.webz.biz" target="_blank"
                                    class="w-12 h-12 flex items-center justify-center rounded bg-black text-white text-3xl">
                                    <i class="fab fa-tiktok"></i>
                                </a>

                                <a href="https://wa.me/+6285798765798" target="_blank"
                                    class="w-12 h-12 flex items-center justify-center rounded bg-green-500 text-white text-3xl">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                <a href="tel:+6285798765798" target="_blank"
                                    class="w-12 h-12 flex items-center justify-center rounded bg-green-400 text-white text-2xl">
                                    <i class="fa-solid fa-phone"></i>
                                </a>
                            </div>
                        </div>
                    </div>
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

            @keyframes marquee {
                0% {
                    transform: translateX(10%);
                }

                100% {
                    transform: translateX(-10%);
                }
            }

            .animate-marquee {
                animation: marquee 5s linear infinite;
                white-space: nowrap;
                position: relative;
                z-index: 10;
            }
        </style>
    </div>
</x-layout.guest>