<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full px-5 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-5 sm:space-y-8 bg-white">
        {{-- Banner --}}
        @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

        {{-- Article Terbaru --}}
        <div class="w-full max-w-[1080px] mx-auto px-3 sm:px-0">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
                <div class="w-full col-span-1 md:col-span-4 space-y-5 sm:space-y-8">
                    {{-- Title --}}
                    <div class="w-full flex justify-between items-center px-2 sm:px-0">
                        <div class="w-full flex items-center gap-2 sm:gap-4">
                            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
                            <p class="text-xl sm:text-3xl font-bold">Artikel Terbaru</p>
                        </div>
                    </div>

                    {{-- Article Grid --}}
                    <div class="w-full grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 mb-8">
                        @forelse (array_slice($data, 0, 3) as $item)
                        <div class="w-full px-1 sm:px-0">
                            @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                        </div>
                        @empty
                        <div class="col-span-2 md:col-span-3 w-full flex justify-center text-center">
                            <p class="text-neutral-600">Article tidak ditemukan</p>
                        </div>
                        @endforelse

                        {{-- Lihat Lainnya Button --}}
                        @if (count($data) > 3)
                        {{-- Mobile --}}
                        <div class="md:hidden col-span-1 flex items-center justify-center">
                            <a href="{{ route('article') }}" class="group">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 bg-main rounded-full flex items-center justify-center shadow-lg group-hover:bg-green-900 transition-all duration-300">
                                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white">
                                            <path fill="none" d="M0 0h256v256H0z"></path>
                                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="24" d="m96 48 80 80-80 80"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs mt-1 text-main group-hover:text-green-900 transition-colors duration-300">Lihat Lainnya</span>
                                </div>
                            </a>
                        </div>
    
                        {{-- Desktop --}}
                        <div class="hidden md:flex justify-center mt-6">
                            <a href="{{ route('article') }}">
                                <button class="px-4 py-2 bg-main text-white rounded-full hover:bg-green-900 transition duration-300 text-sm sm:text-base whitespace-nowrap flex items-center gap-1">
                                    Lihat Lainnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Artikel Populer --}}
        <div class="w-full max-w-[1080px] mx-auto px-3 sm:px-0 mt-4">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
                <div class="w-full col-span-1 md:col-span-4 space-y-5 sm:space-y-8">
                    {{-- Title --}}
                    <div class="w-full flex justify-between items-center px-2 sm:px-0">
                        <div class="w-full flex items-center gap-2 sm:gap-4">
                            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
                            <p class="text-xl sm:text-3xl font-bold">Artikel Populer</p>
                        </div>
                    </div>

                    {{-- Marquee --}}
                    <div class="w-full overflow-hidden py-4 px-2 sm:px-0">
                        <div class="marquee-container whitespace-nowrap">
                            <div class="marquee-content inline-flex gap-2">
                                @foreach(array_merge($trend, $trend) as $item)
                                <div class="inline-block w-[48vw] sm:w-[32vw] flex-shrink-0 px-2">
                                    @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .marquee-container {
            overflow: hidden;
        }

        .marquee-content {
            animation: marquee 40s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 640px) {
            .swiper-slide {
                padding: 0 8px !important;
            }

            .trend-articles-pagination {
                padding: 0 12px !important;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (window.innerWidth < 768) {
                new Swiper(".trendArticlesSwiper", {
                    slidesPerView: 1.1,
                    spaceBetween: 12,
                    centeredSlides: false,
                    loop: true,
                    pagination: {
                        el: ".trend-articles-pagination",
                        clickable: true,
                    },
                });
            }

            const adjustMarquee = () => {
                const content = document.querySelector('.marquee-content');
                if (content) {
                    const items = content.querySelectorAll('div');
                    const itemWidth = items[0]?.offsetWidth || 300;
                    const totalWidth = (itemWidth + 16) * items.length;
                    content.style.animationDuration = `${totalWidth/30}s`;
                }
            };
            window.addEventListener('resize', adjustMarquee);
            adjustMarquee();
        });
    </script>
</x-layout.guest>