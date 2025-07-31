<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    {{-- Swiper Assets --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">

    <div class="w-full overflow-x-hidden">

        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Artikel Terbaru --}}
        <section class="w-full max-w-[1080px] mx-auto px-4 py-16">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-10 bg-main rounded-full"></div>
                <h2 class="text-2xl sm:text-3xl font-bold">Artikel Terbaru</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach (array_slice($data, 0, 6) as $item)
                <div class="min-w-[250px] md:min-w-0 transform hover:scale-[1.02] transition duration-500">
                    @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                </div>
                @endforeach
            </div>

            @if (count($data) > 3)
            <div class="w-full flex justify-center mt-6">
                <a href="{{ route('article') }}">
                    <button class="px-4 py-2 text-sm font-semibold md:font-normal bg-main text-white rounded-full hover:bg-blue-900 transition duration-300">
                        Lihat Lainnya
                    </button>
                </a>
            </div>
            @endif
        </section>

        {{-- Artikel Populer --}}
        <section class="w-full max-w-[1080px] mx-auto px-4 py-16">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-10 bg-main rounded-full"></div>
                <h2 class="text-2xl sm:text-3xl font-bold">Artikel Populer</h2>
            </div>
            <div class="relative">
                <div class="swiper desktopTrendSwiper">
                    <div class="swiper-wrapper">
                        @foreach (array_slice($data, 0, 5) as $item)
                        <div class="swiper-slide max-w-xs">
                            @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </div>

    {{-- Swiper Init --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Banner Swiper
            new Swiper(".heroSwiper", {
                loop: true,
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".hero-banner-pagination",
                    clickable: true,
                },
            });

            // Artikel Populer Swiper
            new Swiper(".desktopTrendSwiper", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                loop: true,
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                },
                spaceBetween: 30,
                breakpoints: {
                    640: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
            });
        });
    </script>

    {{-- Swiper Styles --}}
    <style>
        .swiper-slide {
            border-radius: 12px;
        }

        @media (max-width: 640px) {
            .swiper-slide {
                box-sizing: border-box;
            }
        }
    </style>
</x-layout.guest>
