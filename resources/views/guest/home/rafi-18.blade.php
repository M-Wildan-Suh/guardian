<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <!-- CSS Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- JS Swiper -->

    <div class="w-full max-w-[1080px] mx-auto px-3 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">

        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Banner 2 --}}
        <div class="w-full max-w-[1080px] mx-auto p-4 sm:p-6 mb-4">
            <div class="flex gap-4">
                @foreach (collect($data)->shuffle()->take(4) as $item)
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

        {{-- Article --}}
        <div class="w-full max-w-[1200px] mx-auto px-5 sm:px-8 pt-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                {{-- Main Content --}}
                <div class="col-span-1 md:col-span-3 space-y-10">

                    {{-- Section Title --}}
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-10 bg-second rounded-full"></div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold">Artikel Terbaru</h2>
                    </div>

                    {{-- Hero Artikel --}}
                    @if(isset($trend[0]))
                    <a href="{{ route('detail', ['slug' => $trend[0]->slug]) }}"
                        class="block relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                        <img src="{{ $trend[0]->banner 
                            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $trend[0]->banner 
                            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $trend[0]->judul }}"
                            class="w-full h-[420px] object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <h3 class="text-2xl sm:text-3xl hover:text-blue-400 font-bold line-clamp-2">{{ $trend[0]->judul }}</h3>
                            <p class="mt-2 text-sm sm:text-base text-gray-200 line-clamp-3">
                                {!! nl2br(Str::limit(strip_tags($trend[0]->article), 180)) !!}
                            </p>
                        </div>
                    </a>
                    @endif

                    {{-- Masonry Artikel --}}
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">

                            {{-- Loop data dari $trend --}}
                            @foreach($trend as $item)
                            <div class="swiper-slide">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                    class="group relative block rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">

                                    <!-- Gambar -->
                                    <img src="{{ $item->banner 
                                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-64 object-cover group-hover:scale-110 transition duration-500" />

                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>

                                    <!-- Konten -->
                                    <div class="absolute bottom-0 p-4 text-white">
                                        <h3 class="text-lg font-bold line-clamp-2 group-hover:text-blue-300">
                                            {{ $item->judul }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-200 line-clamp-2">
                                            {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endforeach

                            {{-- Loop data dari $data --}}
                            @foreach($data as $item)
                            <div class="swiper-slide">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                    class="group relative block rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">

                                    <!-- Gambar -->
                                    <img src="{{ $item->banner 
                                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-64 object-cover group-hover:scale-110 transition duration-500" />

                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>

                                    <!-- Konten -->
                                    <div class="absolute bottom-0 p-4 text-white">
                                        <h3 class="text-lg font-bold line-clamp-2 group-hover:text-blue-300">
                                            {{ $item->judul }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-200 line-clamp-2">
                                            {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endforeach

                        </div>

                        <!-- Navigasi -->
                        </div>

                    {{-- Pagination --}}
                    @include('components.section.pagination')
                </div>

                {{-- Sidebar Populer --}}
                <div>
                    <div class="md:sticky top-24 space-y-6 pb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-8 bg-second rounded-full"></div>
                            <h3 class="text-xl font-bold">Artikel Populer</h3>
                        </div>
                        @include('components.section.popular')
                    </div>
                </div>

            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
            },
        });
    </script>
</x-layout.guest>