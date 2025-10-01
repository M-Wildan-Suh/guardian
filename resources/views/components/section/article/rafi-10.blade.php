<div class="w-full flex flex-col rounded-xl overflow-hidden shadow-article hover:shadow-article-lg transition-all duration-300 bg-white article-card">
    {{-- Image --}}
    <div class="relative">
        <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
            <div class="w-full aspect-video bg-gray-100 overflow-hidden">
                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-[1.04]"
                    alt="{{ $item->judul }}"
                    loading="lazy">
            </div>
        </a>

        <div class="absolute bottom-3 left-3 flex flex-wrap gap-2 z-30 p-1 rounded">
            @foreach ($item->articles->articlecategory as $category)
            <a href="{{ route('category', ['category' => $category->slug]) }}"
                class="article-badge px-3 py-1 bg-second text-white text-xs font-medium rounded-full shadow-sm hover:shadow-md transition">
                {{ $category->category }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Content --}}
    <div class="p-5 flex flex-col gap-3">
        {{-- Title --}}
        <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
            <h3 class="text-lg font-semibold text-gray-900 line-clamp-2 hover:text-blue-600 transition-colors article-title">
                {{ $item->judul }}
            </h3>
        </a>
        <p class="mt-1 text-sm text-gray-600 line-clamp-3 article-desc">
            {!! Str::limit(strip_tags($item->article), 50) !!}
        </p>

        <!-- <div class="flex items-center justify-between text-sm text-gray-500 article-meta">
            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                class="font-medium hover:text-blue-600 flex items-center gap-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ $item->articles->user->name }}
            </a>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $item->date }}
            </span>
        </div> -->
    </div>
</div>

<style>
    .article-card {
        border: 1px solid #e5e7eb;
    }

    .shadow-article {
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .shadow-article-lg {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }
</style>