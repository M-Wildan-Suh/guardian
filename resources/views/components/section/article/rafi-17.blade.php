<div class="w-full flex flex-col rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 bg-white">
    {{-- Image --}}
    <div class="relative">
        <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
            <div class="w-full aspect-video bg-gray-100 overflow-hidden">
                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    alt="{{ $item->judul }}"
                    loading="lazy">
            </div>
        </a>
        <div class="absolute bottom-3 left-3 right-3 flex flex-wrap gap-2">
            @foreach ($item->articles->articlecategory as $category)
                <a href="{{ route('category', ['category' => $category->slug]) }}"
                    aria-label="{{ $category->category }}"
                    class="inline-block px-3 py-1 bg-white/90 backdrop-blur-sm text-xs font-medium text-gray-800 rounded-full shadow-sm hover:bg-white transition-colors">
                    {{ $category->category }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Content --}}
    <div class=" py-4 px-2 text-sm flex flex-grow flex-col gap-2 justify-between">
        <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
            <p class=" line-clamp-2 font-bold hover:text-blue-600 duration-300">{{ $item->judul }}</p>
        </a>
        <div class=" grid text-xs sm:text-sm sm:grid-cols-2 gap-2">
            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}" aria-label="{{$item->judul}}">
                <p class="font-bold text-neutral-600 hover:text-blue-600 duration-300">{{$item->articles->user->name}}</p>
            </a>
            <p class=" text-right text-neutral-600">{{$item->date}}</p>
        </div>
    </div>
</div>