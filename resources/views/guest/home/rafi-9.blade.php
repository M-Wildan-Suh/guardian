<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" 
                :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" 
                :category="$category">

    <div class="w-full overflow-hidden bg-background">

        {{-- Banner --}}
        <section class="relative h-[calc(50vh-40px)] sm:h-[calc(100vh-80px)] w-full">
            <div class="swiper mainBannerSwiper h-full w-full">
                <div class="swiper-wrapper">
                    @foreach (array_slice($trend, 0, 4) as $item)
                        <div class="swiper-slide relative">
                            <img src="{{ $item->banner 
                                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-full object-cover" />

                            <div class="absolute inset-0 bg-black/40 flex flex-col justify-center text-center px-6 sm:px-10 text-white">
                                <div class="flex flex-wrap justify-center gap-2 mb-2">
                                    @foreach ($item->articles->articlecategory as $category)
                                        <a href="{{ route('category', ['category' => $category->slug]) }}"
                                           class="bg-white text-gray-700 text-xs px-3 py-1 rounded-full">
                                            {{ $category->category }}
                                        </a>
                                    @endforeach
                                </div>
                                <h2 class="text-xl sm:text-3xl font-bold line-clamp-2">{{ $item->judul }}</h2>
                                <p class="mt-2 text-sm sm:text-base line-clamp-2">{!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination main-banner-pagination"></div>
            </div>
        </section>

        {{-- Artikel --}}
        <div class="w-full max-w-[1080px] mx-auto mt-5 px-4 sm:px-0">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8">

                {{-- Artikel Terbaru --}}
                <div class="w-full col-span-1 md:col-span-3 space-y-6 sm:space-y-8">
                    {{-- Title --}}
                    <div class="flex items-center gap-2 sm:gap-4">
                        <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                        <p class="text-xl sm:text-3xl font-bold text-gray-800">Artikel Terbaru</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        @foreach(array_slice($trend, 0, 6) as $item)
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}" 
                               class="relative group block w-full h-64 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                                
                                <img src="{{ $item->banner 
                                            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                     alt="{{ $item->judul }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />

                                {{-- Overlay --}}
                                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition-colors duration-300"></div>

                                <div class="absolute bottom-0 p-5 text-white">
                                    <h3 class="text-2xl font-bold line-clamp-2">{{ $item->judul }}</h3>
                                    <p class="mt-1 text-sm line-clamp-2">{!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Artikel Populer --}}
                <div>
                    <div class="md:sticky top-24 space-y-4 sm:space-y-6 pb-8">
                        {{-- Title --}}
                        <div class="flex items-center gap-2 h-7 sm:h-10">
                            <div class="w-1 h-7 bg-second rounded-full"></div>
                            <p class="text-xl font-bold">Artikel Populer</p>
                        </div>

                        <div class="flex flex-col gap-4">
                            @foreach (collect($data)->shuffle()->take(5) as $item)
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                   class="relative group rounded-xl overflow-hidden h-32 w-full cursor-pointer">
                                    
                                    <img src="{{ $item->banner 
                                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                         alt="{{ $item->judul }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />

                                    <div class="absolute inset-0 bg-black/60 transition-opacity duration-300 group-hover:bg-black/30"></div>

                                    <div class="absolute bottom-4 right-4 flex flex-col justify-center text-white space-y-1 max-w-[70%] text-right">
                                        <p class="line-clamp-2 font-bold hover:text-blue-600 duration-300 text-sm">
                                            {{ $item->judul }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lihat Semua Artikel --}}
            <div class="flex justify-center mb-8 pt-4">
                <a href="{{ route('article') }}"
                   class="inline-block px-6 py-3 text-white hover:text-main bg-second text-base rounded-full font-semibold transition-colors duration-300">
                    Lihat Lainnya
                </a>
            </div>
        </div>
    </div>

    <script>
        new Swiper(".mainBannerSwiper", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".main-banner-pagination",
                clickable: true,
            },
        });
    </script>

</x-layout.guest>
