<div class="w-full max-w-[1080px] mx-auto">
    <div class="w-full">
        <div class="swiper mySwiper relative rounded-lg overflow-hidden h-64 sm:h-96">

            <!-- Slides -->
            <div class="swiper-wrapper">
                @foreach (array_slice($trend, 0, 4) as $item)
                    <div class="swiper-slide relative w-full h-full">
                        <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}" class="w-full h-full object-cover" />

                        <!-- Overlay -->
                        <div
                            class="absolute inset-0 bg-black/30 flex flex-col justify-end text-white p-4 sm:p-6 space-y-2">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($item->articles->articlecategory as $category)
                                    <a href="{{ route('category', ['category' => $category->slug]) }}"
                                        class="bg-white text-gray-700 text-xs px-3 py-1 rounded-full">
                                        {{ $category->category }}
                                    </a>
                                @endforeach
                            </div>

                            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                class="font-bold text-xl sm:text-2xl line-clamp-2">
                                {{ $item->judul }}
                            </a>

                            <p class="text-sm sm:text-base line-clamp-2">
                                {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                            </p>

                            <p class="text-xs sm:text-sm font-light pt-2">
                                <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                                    class="font-semibold">
                                    {{ $item->articles->user->name }}
                                </a>, {{ $item->date }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Progressbar Pagination -->
            <div class="swiper-pagination absolute bottom-0 left-0 w-full h-1 bg-white/20 z-10"></div>

            <!-- Arrows -->
            <div class="swiper-button-next !text-white hidden sm:flex"></div>
            <div class="swiper-button-prev !text-white hidden sm:flex"></div>
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
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
            });
        });
    </script>
</div>
