<div class="w-screen relative">
    <div class="w-full h-[50vh] sm:h-screen">
        <div class="swiper heroSwiper w-full h-full relative">
            <div class="swiper-wrapper">
                @foreach (array_slice($trend, 0, 4) as $item)
                <div class="swiper-slide relative w-full h-full">
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <img
                            src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover brightness-[0.6]" />
                    </a>

                    {{-- Overlay --}}
                    <div class="absolute inset-x-0 bottom-0 z-10 px-6 pb-12 sm:pb-24">
                        <div class="backdrop-blur-md bg-white/10 border border-white/20 rounded-xl p-6 text-white max-w-3xl mx-auto shadow-lg animate-fadeInUp">
                            <div class="flex flex-wrap gap-2 justify-center mb-4">
                                @foreach ($item->articles->articlecategory as $category)
                                <a href="{{ route('category', ['category' => $category->slug]) }}"
                                    class="text-xs px-3 py-1 border border-white/40 rounded-full flex items-center gap-1 backdrop-blur-sm bg-white/20 hover:bg-white/30 transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                    {{ $category->category }}
                                </a>
                                @endforeach
                            </div>

                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h2 class="text-2xl sm:text-3xl font-bold leading-tight text-center line-clamp-2 hover:text-gray-300 transition">
                                    {{ $item->judul }}
                                </h2>
                            </a>

                            <p class="text-sm sm:text-base mt-2 text-center line-clamp-2">
                                {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                            </p>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Swiper Pagination --}}
            <div class="hero-banner-pagination swiper-pagination !bottom-6"></div>

            {{-- Progress bar horizontal --}}
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20">
                <div class="autoplay-progress-bar h-full bg-white/80 transition-all duration-500 ease-linear w-0"></div>
            </div>
        </div>
    </div>
</div>

{{-- Style --}}
<style>
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out both;
    }
</style>

{{-- Script Progress Bar --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const swiper = new Swiper(".heroSwiper", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".hero-banner-pagination",
                clickable: true,
                renderBullet: function(index, className) {
                    return `<span class="${className} w-3 h-3 bg-white opacity-50 hover:opacity-100 transition mx-1 rounded-full"></span>`;
                },
            },
            on: {
                autoplayTimeLeft(s, time, progress) {
                    const progressBar = document.querySelector(".autoplay-progress-bar");
                    if (progressBar) {
                        progressBar.style.width = `${(1 - progress) * 100}%`;
                    }
                }
            }
        });
    });
</script>