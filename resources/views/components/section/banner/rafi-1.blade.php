    <div class="w-full max-w-[1080px] mx-auto rounded-lg overflow-hidden h-64 sm:h-96 shadow-lg">
        <div class="swiper mySwiper relative w-full h-full">
            <div class="swiper-wrapper">
                @foreach (array_slice($trend, 0, 4) as $item)
                    <div class="swiper-slide relative w-full h-full">
                        <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}" class="w-full h-full object-cover" />

                        <div class="absolute inset-0 bg-black/30 flex flex-col justify-end text-white p-4 sm:p-6 space-y-2">
                            <div class="flex flex-wrap gap-1 sm:gap-2">
                                @foreach ($item->articles->articlecategory as $category)
                                    <a href="{{ route('category', ['category' => $category->slug]) }}"
                                        class="bg-white text-gray-700 text-xs px-2 sm:px-3 py-0.5 sm:py-1 rounded-full">
                                        {{ $category->category }}
                                    </a>
                                @endforeach
                            </div>

                            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                class="font-bold text-lg sm:text-xl line-clamp-1">
                                {{ $item->judul }}
                            </a>

                            <p class="text-sm line-clamp-1">
                                {!! nl2br(Str::limit(strip_tags($item->article), 80)) !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>

<style>
    .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        opacity: 0.5;
        background-color: white;
        transition-duration: 300ms;
        border-radius: 9999px;
    }

    .swiper-pagination-bullet-active {
        width: 24px;
        opacity: 1;
        background-color: white;
    }
</style>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        new Swiper('.mySwiper', {
            loop: true,
            speed: 700,
            pagination: {
                el: '.swiper-pagination',
                type: 'progressbar',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    });
</script>