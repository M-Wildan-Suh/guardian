<div class="w-screen relative mt-[40px] sm:mt-[80px]">
  <div class="w-full h-[calc(60vh-40px)] sm:h-[calc(100vh-80px)]">
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

                    <div class="absolute inset-0 flex flex-col items-center justify-center px-6 text-white">
                            <div class="flex flex-wrap gap-2 justify-center mb-4">
                                @foreach ($item->articles->articlecategory as $category)
                                <a href="{{ route('category', ['category' => $category->slug]) }}"
                                    {{ $category->category }}
                                </a>
                                @endforeach
                            </div>

                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h2 class="text-2xl sm:text-3xl font-bold leading-tight text-center line-clamp-2 hover:text-blue-600 transition">
                                    {{ $item->judul }}
                                </h2>
                            </a>

                            <p class="text-sm sm:text-base mt-2 text-center line-clamp-2">
                                {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                            </p>

                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

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
                renderBullet: function (index, className) {
                    return `<span class="${className} w-3 h-3 bg-main opacity-50 hover:opacity-100 transition mx-1 rounded-full"></span>`;
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