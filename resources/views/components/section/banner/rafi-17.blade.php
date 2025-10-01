<div class="w-screen relative">
  <div class="w-full h-[calc(60vh-40px)] sm:h-[calc(100vh-80px)]">
        <div class="swiper heroSwiper w-full h-full relative">
            <div class="swiper-wrapper">
                @foreach (array_slice($trend, 0, 4) as $item)
                <div class="swiper-slide relative w-full h-full">
                    {{-- Gambar --}}
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <img
                            src="{{ $item->banner 
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover" />
                    </a>

                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

                    {{-- Konten kiri bawah --}}
                    <div class="absolute bottom-0 left-0 p-6 sm:p-10 text-white max-w-2xl space-y-3 animate-fadeInUp">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($item->articles->articlecategory as $category)
                            <a href="{{ route('category', ['category' => $category->slug]) }}"
                                class="bg-white/90 text-gray-900 text-xs px-3 py-1 rounded-full hover:bg-white transition">
                                {{ $category->category }}
                            </a>
                            @endforeach
                        </div>

                        <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                            <h2 class="text-2xl sm:text-4xl font-bold leading-snug hover:text-blue-400 transition line-clamp-2">
                                {{ $item->judul }}
                            </h2>
                        </a>

                        <p class="text-sm sm:text-base text-gray-200 line-clamp-2">
                            {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                        </p>

                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-20">
                <div class="hero-banner-pagination swiper-pagination !relative !bottom-0"></div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 0.8s ease-out both; }
    .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
        width: 12px;
        height: 12px;
        transition: all .3s;
    }
    .swiper-pagination-bullet-active {
        opacity: 1;
        width: 30px;
        border-radius: 6px;
        background: #3b82f6;
    }
</style>
