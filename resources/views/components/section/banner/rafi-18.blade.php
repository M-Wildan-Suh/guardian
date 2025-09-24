<div class="w-full max-w-[1080px] mx-auto">
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-8">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-4">
            @foreach (array_slice($data, 0, 4) as $item)
            <div class="w-full h-44 md:h-full overflow-hidden relative rounded-md">
                <div class="absolute inset-0">
                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-full object-cover" alt="">
                </div>
                <div class="w-full h-full flex items-end relative bg-black/40 hover:bg-black/20 duration-300">
                    <div class="w-full py-4 text-white">
                        <div class="px-4 sm:px-6 space-y-2">
                            <div class="w-full flex flex-wrap gap-2">
                                @foreach ($item->articles->articlecategory as $category)
                                <a href="{{ route('category', ['category' => $category->slug]) }}">
                                    <div class="py-0.5 px-3 bg-white text-gray-600 text-xs rounded-full">
                                        {{ $category->category }}
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <p class="text-base sm:text-lg font-bold line-clamp-2">{{ $item->judul }}</p>
                            </a>
                            <p class="text-sm sm:text-base line-clamp-2">
                                {!! nl2br(Str::limit(strip_tags($item->article), 80)) !!}
                            </p>
                        </div>
                        <p class="px-4 sm:px-6 pt-2 text-xs">
                            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}" class="font-semibold">{{ $item->articles->user->name }}</a>, {{ $item->date }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-4">
            @foreach (array_slice($trend, 0, 4) as $item)
            <div class="w-full h-44 md:h-full overflow-hidden relative rounded-md">
                <div class="absolute inset-0">
                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-full object-cover" alt="">
                </div>
                <div class="w-full h-full flex items-end relative bg-black/40 hover:bg-black/20 duration-300">
                    <div class="w-full py-4 text-white">
                        <div class="px-4 sm:px-6 space-y-2">
                            <div class="w-full flex flex-wrap gap-2">
                                @foreach ($item->articles->articlecategory as $category)
                                <a href="{{ route('category', ['category' => $category->slug]) }}">
                                    <div class="py-0.5 px-3 bg-white text-gray-600 text-xs rounded-full">
                                        {{ $category->category }}
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <p class="text-base sm:text-lg font-bold line-clamp-2">{{ $item->judul }}</p>
                            </a>
                            <p class="text-sm sm:text-base line-clamp-2">
                                {!! nl2br(Str::limit(strip_tags($item->article), 80)) !!}
                            </p>
                        </div>
                        <p class="px-4 sm:px-6 pt-2 text-xs">
                            <a   href="{{ route('author', ['username' => $item->articles->user->slug]) }}" class="font-semibold">{{ $item->articles->user->name }}</a>, {{ $item->date }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>