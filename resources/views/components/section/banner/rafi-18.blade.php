<div class="w-full max-w-[1080px] mx-auto space-y-6">
    {{-- Banner Utama --}}
    @php $item = $data[2] ?? null; @endphp
    @if($item)
    <div class="w-full h-[420px] md:h-[500px] overflow-hidden relative rounded-lg">
        <div class="absolute inset-0">
            <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                class="w-full h-full object-cover" alt="">
        </div>
        <div class="w-full h-full flex items-end relative bg-gradient-to-t from-black/60 via-black/20 to-transparent">
            <div class="w-full p-6 text-white">
                {{-- kategori --}}
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach ($item->articles->articlecategory as $category)
                    <a href="{{ route('category', ['category' => $category->slug]) }}">
                        <div class="py-0.5 px-3 bg-white/90 text-gray-700 text-xs rounded-full">
                            {{ $category->category }}
                        </div>
                    </a>
                    @endforeach
                </div>
                {{-- judul --}}
                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold line-clamp-2 drop-shadow-lg">
                        {{ $item->judul }}
                    </h2>
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- Grid Bawah 2 Kolom --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        {{-- Dari data kiri --}}
        @foreach (array_slice($data, 0, 2) as $item)
        <div class="w-full h-48 overflow-hidden relative rounded-md">
            <div class="absolute inset-0">
                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    class="w-full h-full object-cover" alt="">
            </div>
            <div class="w-full h-full flex items-end relative bg-black/40 hover:bg-black/20 duration-300">
                <div class="w-full p-4 text-white">
                    {{-- kategori --}}
                    <div class="flex flex-wrap gap-2 mb-1">
                        @foreach ($item->articles->articlecategory as $category)
                        <a href="{{ route('category', ['category' => $category->slug]) }}">
                            <div class="py-0.5 px-2 bg-white text-gray-600 text-xs rounded-full">
                                {{ $category->category }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                    {{-- judul --}}
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <p class="text-base font-bold line-clamp-2">{{ $item->judul }}</p>
                    </a>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Dari data trend kanan --}}
        @foreach (array_slice($trend, 0, 2) as $item)
        <div class="w-full h-48 overflow-hidden relative rounded-md">
            <div class="absolute inset-0">
                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    class="w-full h-full object-cover" alt="">
            </div>
            <div class="w-full h-full flex items-end relative bg-black/40 hover:bg-black/20 duration-300">
                <div class="w-full p-4 text-white">
                    {{-- kategori --}}
                    <div class="flex flex-wrap gap-2 mb-1">
                        @foreach ($item->articles->articlecategory as $category)
                        <a href="{{ route('category', ['category' => $category->slug]) }}">
                            <div class="py-0.5 px-2 bg-white text-gray-600 text-xs rounded-full">
                                {{ $category->category }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                    {{-- judul --}}
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <p class="text-base font-bold line-clamp-2">{{ $item->judul }}</p>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>