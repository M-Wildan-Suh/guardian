<div class="w-full relative overflow-hidden min-h-screen">

    <div class="swiper heroSwiper w-full h-screen">
        <div class="swiper-wrapper">
            @foreach (array_slice($trend, 0, 4) as $item)
                <div class="swiper-slide relative">
                    <img src="{{ $item->banner
                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-screen object-cover brightness-[0.55]" />
                </div>
            @endforeach
        </div>

        <div class="hero-banner-pagination swiper-pagination !bottom-5 z-40"></div>
    </div>

    <div class="absolute inset-0 flex items-center z-30 px-6 pb-20 sm:px-12">
        <div class="max-w-xl text-white space-y-4 animate-fadeInUp">

            <div class="flex flex-wrap gap-2">
                @foreach ($item->articles->articlecategory as $category)
                    <span class="text-xs px-3 py-1 bg-white/25 border border-white/30 rounded-full backdrop-blur-sm">
                        {{ $category->category }}
                    </span>
                @endforeach
            </div>

            <h2 class="text-3xl sm:text-5xl font-bold leading-tight drop-shadow-lg line-clamp-2">
                {{ $item->judul }}
            </h2>

            <p class="text-sm sm:text-base text-gray-200 drop-shadow-lg line-clamp-2">
                {!! nl2br(Str::limit(strip_tags($trend[0]->article), 150)) !!}
            </p>

        </div>
    </div>

    <div class="hidden md:block absolute right-8 top-1/2 -translate-y-1/2 z-40">

        @php $item = $data[1] ?? null; @endphp
        @if ($item)
            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                <div
                    class="w-64 bg-white rounded-2xl shadow-xl overflow-hidden backdrop-blur-md bg-white/80 border border-white/40 hover:scale-[1.03] transition">

                    <img src="{{ $item->banner
                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-36 object-cover" />

                    <div class="p-4">
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach ($item->articles->articlecategory as $categories)
                                <span
                                    class="text-[10px] px-2 py-[2px] bg-main/10 border border-main/20 text-black rounded-full">
                                    {{ $categories->category }}
                                </span>
                            @endforeach
                        </div>

                        <h3 class="text-base font-bold line-clamp-2 hover:text-black transition">
                            {{ $item->judul }}
                        </h3>
                    </div>

                </div>
            </a>
        @endif
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
        animation: fadeInUp .7s ease-out both;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        new Swiper(".heroSwiper", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".hero-banner-pagination",
                clickable: true
            },
        });
    });
</script>
