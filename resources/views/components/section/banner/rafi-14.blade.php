<div class="w-full max-w-[1200px] mx-auto px-4 sm:px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Banner Swiper --}}
        <div class="col-span-2">
            <div class="swiper relative w-full h-[70vh] sm:h-[80vh] rounded-xl overflow-hidden shadow-lg">
                <div class="swiper-wrapper">
                    @foreach (array_slice($trend, 0, 3) as $item)
                    <div class="swiper-slide relative">
                        <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/'. $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            class="w-full h-full object-cover" alt="{{ $item->judul }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end">
                            <div class="p-6 md:p-10 text-white space-y-3 max-w-3xl">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->articles->articlecategory as $category)
                                    <a href="{{route('category', ['category' => $category->slug])}}">
                                        <span class="py-0.5 px-3 bg-main text-gray-700 text-xs rounded-full">
                                            {{ $category->category }}
                                        </span>
                                    </a>
                                    @endforeach
                                </div>
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <h2 class="text-3xl md:text-4xl font-bold line-clamp-2 hover:text-main">
                                        {{ $item->judul }}
                                    </h2>
                                </a>
                                <p class="line-clamp-3 text-sm md:text-base text-gray-200">
                                    {!! nl2br(Str::limit(strip_tags($item->article), 200)) !!}
                                </p>
                                <p class="text-xs md:text-sm text-gray-300">
                                    <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                                        class="font-semibold">
                                        {{ $item->articles->user->name }}
                                    </a>, {{ $item->date }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="absolute bottom-4 left-0 right-0 flex justify-center">
                    <div class="pagination"></div>
                </div>
            </div>
        </div>

        {{-- Sidebar Artikel Populer --}}
        <div class="col-span-1">
            <div class="sticky top-20 space-y-6">
                <h3 class="text-xl font-bold border-b border-gray-200 pb-2">Artikel Populer</h3>
                <div class="space-y-4">
                    @foreach(array_slice($trend, 2, 5) as $item)
                    <div class="flex gap-4 items-center">
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="shrink-0">
                            <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-28 h-20 object-cover rounded-md" />
                        </a>
                        <div>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($item->articles->articlecategory as $category)
                                <a href="{{route('category', ['category' => $category->slug])}}">
                                    <span class="py-0.5 px-3 bg-main text-white text-sm rounded-full">
                                        {{ $category->category }}
                                    </span>
                                </a>
                                @endforeach
                            </div>
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h4 class="text-sm font-semibold text-gray-800 hover:text-main line-clamp-2">
                                    {{ $item->judul }}
                                </h4>
                            </a>
                            <p class="text-xs md:text-sm text-black hover:text-blue-600">
                                    <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                                        class="font-semibold">
                                        {{ $item->articles->user->name }}
                                    </a>, {{ $item->date }}
                                </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
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
    window.addEventListener('load', function() {
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: true,
            speed: 500,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return `<span class="${className}"></span>`;
                },
            },
        });
    });
</script>