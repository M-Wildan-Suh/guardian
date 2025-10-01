<div class="w-screen relative">
  <div class="w-full h-[calc(50vh-40px)] sm:h-[calc(100vh-80px)]">
        <div class="swiper heroSwiper w-full h-full relative">
            <div class="swiper-wrapper">
                @foreach (array_slice($trend, 0, 4) as $item)
                <div class="swiper-slide relative w-full h-full">
                    {{-- Banner --}}
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <img
                            src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover" />
                    </a>

                    <div class="absolute inset-0 bg-black/30 flex flex-col justify-center text-center text-white p-4 sm:p-6 space-y-2">
                        <div class="flex flex-wrap gap-2 mx-auto">
                            @foreach ($item->articles->articlecategory as $category)
                            <a href="{{ route('category', ['category' => $category->slug]) }}"
                                class="bg-white text-gray-700 text-xs px-3 py-1 rounded-full">
                                {{ $category->category }}
                            </a>
                            @endforeach
                        </div>

                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="font-bold text-xl sm:text-3xl line-clamp-2">
                            {{ $item->judul }}
                        </a>

                        <p class="text-sm sm:text-base line-clamp-2">
                            {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                        </p>

                    </div>
                </div>
                @endforeach
            </div>

            <div class="hero-banner-pagination swiper-pagination"></div>
            <div class="autoplay-progress">
                <svg viewBox="0 0 48 48">
                    <circle cx="24" cy="24" r="20"></circle>
                </svg>
                <span></span>
            </div>
        </div>
    </div>
</div>

<style>
    .autoplay-progress {
        position: absolute;
        right: 20px;
        bottom: 20px;
        z-index: 10;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
    }

    .autoplay-progress svg {
        --progress: 0;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        stroke-width: 4px;
        stroke: white;
        fill: none;
        stroke-dashoffset: calc(125.6px * (1 - var(--progress)));
        stroke-dasharray: 125.6;
        transform: rotate(-90deg);
    }
</style>
