<div class="w-full flex justify-center mt-2 sm:mt-4 px-2 sm:px-4">
    <div class="w-full max-w-[1080px]">
        <div
            class="swiper relative w-full h-[260px] sm:h-[400px] lg:h-[500px] rounded-xl sm:rounded-3xl overflow-hidden">
            <div class="swiper-wrapper">
                @foreach (array_slice($trend, 0, 3) as $item)
                    <div class="swiper-slide w-full h-full overflow-hidden relative">
                        <div class="absolute inset-0">
                            <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                class="w-full h-full object-cover" alt="{{ $item->judul }}">
                        </div>

                        <div
                            class="absolute bottom-3 sm:bottom-6 left-3 sm:left-6 right-3 sm:right-6 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-xl">
                            <div class="space-y-2 sm:space-y-4">
                                <div class="flex flex-wrap gap-1 sm:gap-2">
                                    @foreach ($item->articles->articlecategory as $category)
                                        <a href="{{ route('category', ['category' => $category->slug]) }}"
                                            class="px-2 sm:px-3 py-0.5 sm:py-1 bg-main text-white text-[10px] sm:text-xs rounded-full hover:bg-main/90 transition-colors">
                                            {{ $category->category }}
                                        </a>
                                    @endforeach
                                </div>

                                <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="block">
                                    <h2
                                        class="text-lg sm:text-2xl lg:text-3xl font-bold text-white line-clamp-1 hover:text-main transition-colors">
                                        {{ $item->judul }}
                                    </h2>
                                </a>

                                <p class="text-xs sm:text-sm text-white line-clamp-2">
                                    {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination absolute bottom-3 sm:bottom-6 left-1/2 transform -translate-x-1/2 z-10"></div>
        </div>
    </div>
</div>


<style>
    .swiper-pagination-bullet-active {
        width: 16px !important;
        background: transparent !important;
    }
</style>

<script>
    window.addEventListener('load', function() {
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: true,
            speed: 600,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return `<span class="${className}"></span>`;
                },
            },
        });
    });
</script>
