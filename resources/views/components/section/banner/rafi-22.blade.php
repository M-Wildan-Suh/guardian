<div class="w-full flex justify-center px-4">
    <div class="w-full max-w-[1200px] grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="md:col-span-2 relative rounded-lg overflow-hidden">
            <div class="swiper-main relative w-full h-[300px] sm:h-[400px] md:h-[500px] rounded-lg overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach (array_slice($trend, 0, 3) as $item)
                    <div class="swiper-slide w-full h-full relative">
                        <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover brightness-[0.7]" />

                        <div class="absolute inset-0 flex flex-col justify-end p-4 sm:p-6 bg-gradient-to-t from-black/60 via-black/30 to-transparent text-white">
                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach ($item->articles->articlecategory as $category)
                                <span class="bg-white/80 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ strtoupper($category->category) }}
                                </span>
                                @endforeach
                            </div>
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h2 class="text-lg sm:text-2xl font-bold leading-tight line-clamp-2 hover:text-blue-400 transition">
                                    {{ $item->judul }}
                                </h2>
                            </a>
                            <p class="text-xs sm:text-sm mt-2 line-clamp-2 text-gray-200">
                                {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="swiper-pagination-main absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2"></div>
            </div>
        </div>

        <div class="relative rounded-lg overflow-hidden h-[300px] sm:h-[400px] md:h-[500px]">
            @if(isset($trend[3]))
            @php $item = $trend[3]; @endphp
            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    alt="{{ $item->judul }}"
                    class="w-full h-full object-cover brightness-[0.7]" />
            </a>
            <div class="absolute inset-0 flex flex-col justify-end p-4 sm:p-6 bg-gradient-to-t from-black/60 via-black/30 to-transparent text-white">
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach ($item->articles->articlecategory as $category)
                    <span class="bg-white/80 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full">
                        {{ strtoupper($category->category) }}
                    </span>
                    @endforeach
                </div>
                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                    <h2 class="text-lg sm:text-xl font-bold leading-tight line-clamp-2 hover:text-blue-400 transition">
                        {{ $item->judul }}
                    </h2>
                </a>

                <p class="text-xs sm:text-sm mt-2 line-clamp-2 text-gray-200">
                    {!! nl2br(Str::limit(strip_tags($item->article), 90)) !!}
                </p>
            </div>
            @endif
        </div>

    </div>
</div>

<style>
    .swiper-pagination-main .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: white;
        opacity: 0.4;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .swiper-pagination-main .swiper-pagination-bullet-active {
        width: 24px;
        height: 10px;
        border-radius: 9999px;
        background: white;
        opacity: 1;
    }

    @media (max-width: 768px) {
        .swiper-pagination-main .swiper-pagination-bullet-active {
            width: 16px;
            height: 8px;
        }
    }
</style>

<script>
    window.addEventListener('load', () => {
        new Swiper('.swiper-main', {
            loop: true,
            speed: 600,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination-main',
                clickable: true,
            },
        });
    });
</script>