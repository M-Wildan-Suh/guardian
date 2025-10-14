<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    {{-- Banner --}}
    @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

    {{-- Artikel Terbaru --}}
    <div class="w-full max-w-[1080px] mx-auto bg-white rounded-lg shadow-md hidden md:flex flex-col md:flex-row overflow-hidden h-[180px] my-6">
        <div class="w-full md:w-48 bg-main text-white flex-shrink-0">
            <div class="swiper-category h-full">
                <div class="swiper-wrapper">
                    @foreach (array_chunk(array_slice($trend, 0, 8), 2) as $index => $chunk)
                    <div class="swiper-slide">
                        <div class="flex flex-col justify-center items-center h-full p-4">
                            <h3 class="text-lg font-bold mb-4">Kategori</h3>
                            <div class="flex flex-col gap-2 text-center">
                                @php
                                $uniqueCategories = [];
                                foreach($chunk as $item) {
                                if(isset($item->articles->articlecategory)) {
                                foreach($item->articles->articlecategory as $category) {
                                if(!in_array($category->category, $uniqueCategories)) {
                                $uniqueCategories[] = $category->category;
                                }
                                }
                                }
                                }
                                @endphp
                                @foreach($uniqueCategories as $category)
                                <p class="text-sm font-semibold rounded-full px-3 py-1">{{ $category }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex-1 p-4 relative">
            <div class="swiper-topic h-full">
                <div class="swiper-wrapper">
                    @foreach (array_chunk(array_slice($trend, 0, 8), 2) as $chunk)
                    <div class="swiper-slide">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 h-[140px]">
                            @foreach($chunk as $item)
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                class="flex items-center gap-3 bg-gray-50 rounded-md shadow hover:shadow-lg transition-all duration-300 overflow-hidden p-2 border border-gray-100 hover:border-main/20">
                                <div class="w-20 h-16 flex-shrink-0 rounded overflow-hidden">
                                    <img src="{{ $item->banner 
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/'.$item->banner 
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        class="w-full h-full object-cover"
                                        alt="{{ $item->judul }}"
                                        loading="lazy">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap gap-1 mb-1">
                                        @foreach ($item->articles->articlecategory ?? [] as $category)
                                        <span class="bg-gray-200 text-gray-700 text-[10px] px-2 py-0.5 rounded-full font-medium">
                                            {{ $category->category }}
                                        </span>
                                        @endforeach
                                    </div>
                                    <p class="font-semibold text-sm text-gray-800 hover:text-main line-clamp-2 leading-tight">
                                        {{ $item->judul }}
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex md:flex-col justify-center items-center gap-2 p-4 bg-white md:bg-transparent">
            <div class="swiper-button-prev-topic cursor-pointer bg-main text-white hover:bg-main/80 rounded-full w-8 h-8 flex items-center justify-center transition-colors duration-200 shadow">
                <i class="fa-solid fa-chevron-up text-xs"></i>
            </div>
            <div class="swiper-button-next-topic cursor-pointer bg-main text-white hover:bg-main/80 rounded-full w-8 h-8 flex items-center justify-center transition-colors duration-200 shadow">
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </div>
        </div>
    </div>

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

    <div class="w-full max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-6 sm:gap-8 mb-12">

        <div class="md:col-span-3 space-y-8 sm:space-y-10">
            {{-- Judul --}}
            <div class="flex items-center justify-between gap-4">
    {{-- Kiri: Judul --}}
    <div class="flex items-center gap-2 sm:gap-4">
        <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
        <p class="text-xl sm:text-3xl font-bold">Artikel Terbaru</p>
    </div>

    <a href="{{ route('article') }}"
        class="flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
        Baca Selengkapnya
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
    </a>
</div>


            {{-- Artikel Terbaru --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach(array_slice($data, 1, 6) as $item)
                <div
                    class="article-card bg-white rounded-xl shadow-md overflow-hidden flex flex-col cursor-pointer hover:shadow-xl transition-shadow duration-300"
                    data-url="{{ route('detail', ['slug' => $item->slug]) }}">
                    <img src="{{ $item->banner 
                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        alt="{{ $item->judul }}"
                        class="w-full h-44 object-cover rounded-t-xl" />

                    <div class="p-4 flex flex-col flex-grow">
                        <p class="line-clamp-2 font-bold hover:text-blue-600 duration-300">
                            {{ $item->judul }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div>
            <div class="md:sticky top-24 space-y-4 sm:space-y-6">
                <div class="flex items-center gap-2 sm:gap-4">
                    <div class="w-1 h-7 bg-second rounded-full"></div>
                    <p class="text-xl font-bold">Artikel Populer</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4 sm:gap-6">
                    @include('components.section.popular')
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize topic swiper
            const topicSwiper = new Swiper('.swiper-topic', {
                direction: 'vertical',
                slidesPerView: 1,
                spaceBetween: 16,
                loop: true,
                speed: 600,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next-topic',
                    prevEl: '.swiper-button-prev-topic',
                },
            });

            // Initialize category swiper
            const categorySwiper = new Swiper('.swiper-category', {
                direction: 'vertical',
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                speed: 600,
                allowTouchMove: false, // Disable touch for category swiper
                autoHeight: true,
            });

            // Sync both swipers
            topicSwiper.controller.control = categorySwiper;
            categorySwiper.controller.control = topicSwiper;
        });
    </script>

    <style>
        .swiper-topic,
        .swiper-category {
            height: 100%;
        }

        .swiper-slide {
            height: auto;
        }

        /* Custom scrollbar for swiper */
        .swiper-topic::-webkit-scrollbar {
            display: none;
        }

        /* Smooth transitions */
        .swiper-topic .swiper-slide {
            transition: transform 0.3s ease;
        }
    </style>

</x-layout.guest>