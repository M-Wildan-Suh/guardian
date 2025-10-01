<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    <div class="w-full overflow-x-hidden bg-background">
        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        <div class="w-full max-w-[1100px] mx-auto p-4 grid grid-cols-1 md:grid-cols-4 gap-6 pb-4 mt-5">
            <div class="md:col-span-3 space-y-10 md:border-r md:border-gray-300 md:pr-6">
                {{-- Title --}}
                <div class=" w-full flex items-center gap-2 sm:gap-4">
                    <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                    <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(array_slice($data, 0, 6) as $item)
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                        class="relative group overflow-hidden rounded-xl shadow-lg cursor-pointer transition-transform duration-300 hover:scale-105">

                        <img src="{{ $item->banner 
                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />

                        <div class="absolute inset-0 bg-black/35 flex flex-col justify-end p-5">
                            <p class="text-white font-bold text-lg line-clamp-1">{{ $item->judul }}</p>
                            <p class="text-sm text-white line-clamp-2 mt-1">{!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}</p>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @include('components.section.pagination')
            </div>

            {{-- Popular Article --}}
            <div class="md:pl-6">
                <div class=" md:sticky top-24 space-y-4 sm:space-y-6">
                    {{-- Title --}}
                    <div class=" w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10">
                        <div class=" w-1 h-7 bg-second rounded-full"></div>
                        <p class=" text-xl font-bold text-center">Artikel Populer</p>
                    </div>

                    {{-- Article --}}
                    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4 sm:gap-8">
                        @include('components.section.popular')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>