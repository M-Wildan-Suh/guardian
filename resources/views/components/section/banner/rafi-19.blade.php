<div class="w-full max-w-[1080px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
        {{-- KIRI --}}
        <div class="flex flex-col gap-4">
            @foreach (array_slice($data, 0, 2) as $item)
            <div class="w-full h-44 overflow-hidden relative rounded-md">
                <div class="absolute inset-0">
                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-full object-cover" alt="">
                </div>
                <div class="w-full h-full flex items-end relative bg-black/40 hover:bg-black/20 duration-300">
                    <div class="w-full py-3 text-white">
                        <div class="px-3 sm:px-4 space-y-2">
                            {{-- kategori --}}
                            <div class="w-full flex flex-wrap gap-2">
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
                                <p class="text-sm sm:text-base font-bold line-clamp-2">{{ $item->judul }}</p>
                            </a>
                        </div>
                        <p class="px-3 sm:px-4 pt-1 text-xs">
                            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}" class="font-semibold">{{ $item->articles->user->name }}</a>, {{ $item->date }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- TENGAH --}}
        <div>
            @php $item = $data[2] ?? null; @endphp
            @if($item)
            <div class="w-full h-[360px] overflow-hidden relative rounded-md">
                <div class="absolute inset-0">
                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-full object-cover" alt="">
                </div>
                <div class="w-full h-full flex items-end relative bg-black/40 hover:bg-black/20 duration-300">
                    <div class="w-full py-5 text-white">
                        <div class="px-4 sm:px-6 space-y-3">
                            {{-- kategori --}}
                            <div class="w-full flex flex-wrap gap-2">
                                @foreach ($item->articles->articlecategory as $category)
                                <a href="{{ route('category', ['category' => $category->slug]) }}">
                                    <div class="py-0.5 px-3 bg-white text-gray-600 text-xs rounded-full">
                                        {{ $category->category }}
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            {{-- judul --}}
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <p class="text-lg sm:text-xl font-bold line-clamp-2">{{ $item->judul }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- KANAN --}}
        <div class="flex flex-col gap-4">
            @foreach (array_slice($trend, 0, 2) as $item)
            <div class="w-full h-44 overflow-hidden relative rounded-md">
                <div class="absolute inset-0">
                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-full object-cover" alt="">
                </div>
                <div class="w-full h-full flex items-end relative bg-black/40 hover:bg-black/20 duration-300">
                    <div class="w-full py-3 text-white">
                        <div class="px-3 sm:px-4 space-y-2">
                            {{-- kategori --}}
                            <div class="w-full flex flex-wrap gap-2">
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
                                <p class="text-sm sm:text-base font-bold line-clamp-2">{{ $item->judul }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
