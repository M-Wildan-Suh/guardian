<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full overflow-hidden bg-background">

        {{-- Banner --}}
        <section class="relative h-[calc(50vh-40px)] sm:h-[calc(100vh-80px)] w-full">
            <div class="swiper mainBannerSwiper h-full w-full">
                <div class="swiper-wrapper">
                    @foreach (array_slice($trend, 0, 4) as $item)
                    <div class="swiper-slide relative">
                        <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover">
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
                            <p class="mt-2 text-sm sm:text-base line-clamp-2">
                                {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                            </p>
                            <span class="mt-3 text-xs">
                                <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}" class="font-semibold">
                                    {{ $item->articles->user->name }}
                                </a>, {{ $item->date }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination main-banner-pagination"></div>
            </div>
        </section>

        {{-- Artikel Populer --}}
        <div class="w-full max-w-[1080px] mx-auto px-3 sm:px-6 mt-4">
                    <div class=" w-full grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="w-full col-span-1 md:col-span-4 space-y-5 sm:space-y-8">
                    {{-- Title --}}
                    <div class="w-full flex justify-between items-center px-2 sm:px-0">
                        <div class="w-full flex items-center gap-2 sm:gap-4">
                            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                            <p class="text-xl sm:text-3xl text-main font-bold">Artikel Populer</p>
                        </div>
                    </div>

                    {{-- Artikel --}}
                    <div class=" w-full overflow-hidden grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach (array_slice($data, 0, 3) as $item)
                        <div class=" w-full flex-shrink-0">
                            @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Artikel Terbaru --}}
        <section class="py-12 md:py-16 bg-background">
            <div class="container mx-auto px-4 sm:px-6 max-w-6xl">
                <div class="flex items-center gap-3 mb-8 md:mb-10">
                    <div class="w-2 h-10 md:h-12 bg-second rounded-full"></div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-main">Artikel Terbaru</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach (array_slice($data, 0, 3) as $item)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                        @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                    </div>
                    @endforeach
                </div>

                @if (count($data) > 3)
                <div class="w-full flex justify-center mt-6">
                <a href="{{ route('article') }}">
                    <button class="px-4 py-2 text-base font-semibold md:font-normal bg-main text-white rounded-full hover:bg-blue-900 transition duration-300">
                        Lihat Lainnya
                    </button>
                </a>
            </div>
                @endif
            </div>
        </section>
    </div>

    <style>
        .articleSwiper {
            overflow: hidden;
            margin: 0 -8px;
        }

        .articleSwiper .swiper-slide {
            width: 280px !important;
            height: auto;
        }

    </style>

    <script>
        // Banner Swiper
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

        // Artikel Populer Swiper
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper(".articleSwiper", {
                slidesPerView: 'auto',
                spaceBetween: 16,
                centeredSlides: false,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 'auto',
                        spaceBetween: 16
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 16
                    }
                }
            });
        });
    </script>
</x-layout.guest>