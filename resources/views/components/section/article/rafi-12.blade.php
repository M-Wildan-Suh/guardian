<div class="w-full flex flex-col rounded-2xl overflow-hidden bg-white border border-purple-100 shadow-md hover:shadow-xl transition-all duration-300 group article-card-v11">
    {{-- Image --}}
    <div class="relative">
        <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
            <div class="w-full aspect-video bg-gray-100 overflow-hidden">
                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-[1.05]"
                     alt="{{ $item->judul }}"
                     loading="lazy">
            </div>
        </a>

        {{-- Kategori Badge --}}
        <div class="absolute bottom-3 left-3 flex flex-wrap gap-2 z-10">
            @foreach ($item->articles->articlecategory as $category)
            <a href="{{ route('category', ['category' => $category->slug]) }}"
               class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium rounded-full text-white bg-main shadow-md transition">
                {{ $category->category }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Content --}}
    <div class="p-5 flex flex-col gap-3">
        <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
            <h3 class="text-xl font-semibold text-gray-900 leading-snug line-clamp-2 hover:text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 transition-colors duration-300">
                {{ $item->judul }}
            </h3>
        </a>

        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
            {!! Str::limit(strip_tags($item->article), 70) !!}
        </p>

        <div class="flex items-center justify-between text-sm text-gray-500 mt-3">
            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
               class="flex items-center gap-1 font-medium hover:text-pink-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ $item->articles->user->name }}
            </a>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $item->date }}
            </span>
        </div>
    </div>
</div>

<style>
.article-card-v11 {
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}

.article-card-v11:hover {
    transform: translateY(-4px);
}

.article-card-v11 img {
    will-change: transform;
}
</style>
