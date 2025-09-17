<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
  {{-- Banner --}}
    @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

  {{-- Artikel Terbaru --}}
 <div class="w-full max-w-[1100px] mx-auto p-4 grid grid-cols-1 md:grid-cols-4 gap-6 pb-4 mt-5">
    {{-- Artikel Terbaru --}}
    <div class="md:col-span-3 space-y-6 md:border-r md:border-gray-300 md:pr-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-8 bg-second rounded-full"></div>
            <p class="text-2xl font-bold">Artikel Terbaru</p>
        </div>

        {{-- Artikel --}}
        @if(isset($trend[0]))
        <a href="{{ route('detail', ['slug' => $trend[0]->slug]) }}" 
           class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition">
            <img src="{{ $trend[0]->banner 
                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $trend[0]->banner 
                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                alt="{{ $trend[0]->judul }}" class="w-full h-56 object-cover">
            <div class="p-5">
                <p class="font-bold text-2xl mb-3 hover:text-blue-600">{{ $trend[0]->judul }}</p>
                <p class="text-gray-600 line-clamp-3">{!! nl2br(Str::limit(strip_tags($trend[0]->article), 250)) !!}</p>
            </div>
        </a>
        @endif

        {{-- List Artikel --}}
        <div class="space-y-4">
            @foreach(array_slice($trend, 1, 4) as $item)
            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
               class="flex gap-4 items-center bg-white rounded-lg p-3 hover:shadow-md transition">
                <img src="{{ $item->banner 
                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    alt="{{ $item->judul }}" class="w-20 h-20 object-cover rounded-md">
                <div>
                    <p class="font-semibold text-base line-clamp-1 hover:text-blue-600">{{ $item->judul }}</p>
                    <p class="text-sm text-gray-600 line-clamp-2">{!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}</p>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @include('components.section.pagination')
    </div>

    {{-- Artikel Populer --}}
    <div class="md:pl-6">
        <div class="md:sticky top-24 space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-second rounded-full"></div>
                <p class="text-xl font-bold">Artikel Populer</p>
            </div>
            <div class="space-y-4">
                @include('components.section.popular')
            </div>
        </div>
    </div>
</div>


</x-layout.guest>