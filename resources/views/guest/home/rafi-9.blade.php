<x-layout.guest :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    <div class="w-full overflow-hidden bg-white">
        {{-- Banner --}}
        <section class="relative h-[calc(100vh-80px)] w-full">
            <div class="swiper mainBannerSwiper h-full w-full">
                <div class="swiper-wrapper">
                    @foreach (array_slice($trend, 0, 4) as $item)
                    <div class="swiper-slide relative">
                        <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center text-center px-6 sm:px-10 text-white">
                            <div class="flex flex-wrap justify-center gap-2 mb-2">
                                @foreach ($item->articles->articlecategory as $category)
                                <a href="{{ route('category', ['category' => $category->slug]) }}" class="bg-white text-gray-700 text-xs px-3 py-1 rounded-full">
                                    {{ $category->category }}
                                </a>
                                @endforeach
                            </div>
                            <h2 class="text-xl sm:text-3xl font-bold line-clamp-2">{{ $item->judul }}</h2>
                            <p class="mt-2 text-sm sm:text-base line-clamp-2">{!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}</p>
                            <span class="mt-3 text-xs"><a href="{{ route('author', ['username' => $item->articles->user->slug]) }}" class="font-semibold">{{ $item->articles->user->name }}</a>, {{ $item->date }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination main-banner-pagination"></div>
            </div>
        </section>

        {{-- Artikel populer --}}
        <section class="py-20 bg-gradient-to-b from-white via-gray-50 to-white">
            <div class="container mx-auto px-6 max-w-6xl">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-2 h-12 bg-gradient-to-b from-purple-500 to-purple-700 rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-purple-800">Artikel Populer</h2>
                </div>

                <div class="swiper highlightSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($trend as $item)
                        <div class="swiper-slide w-[280px] md:w-[320px]">
                            <div class="rounded-2xl shadow-md overflow-hidden bg-white mb-10">
                                @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination highlight-pagination mt-6"></div>
                </div>
            </div>
        </section>

        {{-- Artikel Terbaru --}}
        <section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="flex items-center gap-3 mb-10">
            <div class="w-2 h-12 bg-gradient-to-b from-blue-500 to-blue-700 rounded-full"></div>
            <h2 class="text-3xl sm:text-4xl font-bold text-blue-800">Artikel Terbaru</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="artikelContainer">
            @foreach (array_slice($data, 0, 6) as $i => $item)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 {{ $i >= 3 ? 'hidden extra-article' : '' }}">
                @include('components.section.article.' . json_decode(\Storage::get('website.json'))->template)
            </div>
            @endforeach
        </div>

        @if (count($data) > 3)
        <div class="mt-12 text-center">
            <button id="toggleArtikelBtn"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-medium transition">
                Tampilkan Lebih Banyak
            </button>
        </div>
        @endif
    </div>
</section>


        <script>
            document.addEventListener("DOMContentLoaded", () => {
                new Swiper(".mainBannerSwiper", {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".main-banner-pagination",
                        clickable: true,
                    },
                });

                new Swiper(".highlightSwiper", {
                    slidesPerView: 'auto',
                    spaceBetween: 20,
                    loop: true,
                    grabCursor: true,
                    pagination: {
                        el: ".highlight-pagination",
                        clickable: true,
                    }
                });
            });

    document.addEventListener("DOMContentLoaded", () => {
        const toggleBtn = document.getElementById("toggleArtikelBtn");
        const extraArticles = document.querySelectorAll(".extra-article");
        let isOpen = false;

        toggleBtn.addEventListener("click", () => {
            isOpen = !isOpen;
            extraArticles.forEach(el => {
                el.classList.toggle("hidden");
            });
            toggleBtn.textContent = isOpen ? "Sembunyikan Artikel" : "Tampilkan Lebih Banyak";
        });
    });
        </script>
    </div>

</x-layout.guest>
