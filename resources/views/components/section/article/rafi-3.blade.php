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
    <div class="p-4 flex flex-col gap-3">
        {{-- Title --}}
        <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
            <h3 class="text-lg font-bold text-gray-900 line-clamp-2 hover:text-blue-600 transition-colors">
                {{ $item->judul }}
            </h3>
        </a>

        {{-- Meta Footer --}}
        <div class="flex items-center justify-between text-sm text-gray-600">
            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                class="font-medium hover:text-blue-600 transition-colors flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ $item->articles->user->name }}
            </a>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $item->date }}
            </span>
        </div>
    </div>
</div>