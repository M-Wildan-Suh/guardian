<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full overflow-x-hidden bg-gray-50">
        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        {{-- Artikel --}}
        <div class="w-full max-w-[1100px] mx-auto p-4 grid grid-cols-1 md:grid-cols-4 gap-6 pb-4 mt-5">
            <div class="md:col-span-3 space-y-10 md:border-r md:border-gray-300 md:pr-6">
                {{-- Title --}}
                <div class=" w-full flex items-center gap-2 sm:gap-4">
                    <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                    <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach (collect($data)->shuffle()->take(4) as $item)
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                        class="relative group rounded-xl overflow-hidden h-64 cursor-pointer">

                        <img src="{{ $item->banner 
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />

                        <div class="absolute inset-0 bg-black/60 transition-opacity duration-300 group-hover:bg-black/30"></div>

                        <div class="absolute bottom-4 right-4 text-white flex flex-col space-y-1 max-w-[70%] text-right">
                            <p class="line-clamp-2 font-bold hover:text-blue-600 duration-300">{{ $item->judul }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-200">
                                <span class="truncate hover:text-blue-600 duration-300">
                                    {{ $item->articles->user->name }}
                                </span>
                                <span class="whitespace-nowrap">
                                    {{ $item->date }}
                                </span>
                            </div>

                        </div>
                    </a>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 gap-6">
                    @foreach (array_slice($data, 0, 1) as $item)
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                        class="relative group w-full h-[400px] rounded-xl overflow-hidden cursor-pointer">

                        <img src="{{ $item->banner 
                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />

                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent 
                    transition-opacity duration-300 group-hover:from-black/60 group-hover:via-black/30">
                        </div>

                        @foreach ($item->articles->articlecategory as $category)
                        <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs px-3 py-1 rounded-full">
                            {{ $category->category }}
                        </span>
                        @endforeach

                        <div class="absolute bottom-0 p-6 text-white space-y-2">
                            <h2 class="font-bold text-2xl leading-tight hover:text-blue-400 duration-300 line-clamp-2">
                                {{ $item->judul }}
                            </h2>
                            <p class="text-sm text-gray-200 line-clamp-3">
                                {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                            </p>
                            <div class="flex items-center gap-3 text-xs text-gray-300">
                                <span class="font-semibold hover:text-blue-400">{{ $item->articles->user->name }}</span>
                                <span>{{ $item->date }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                {{-- Pagination --}}
                @include('components.section.pagination')
            </div>

            {{-- Popular Article --}}
            <div class="md:pl-6">
                <div class="md:sticky top-24 space-y-4 sm:space-y-6">
                    {{-- Title --}}
                    <div class="w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10">
                        <div class="w-1 h-7 bg-second rounded-full"></div>
                        <p class="text-xl font-bold text-center">Artikel Populer</p>
                    </div>

                    {{-- Article --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4 sm:gap-8">
                        @include('components.section.popular')
                    </div>

                    {{-- Grid 4 Card Kecil --}}
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        @foreach (collect($trend)->shuffle()->take(4) as $item)
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="relative group rounded-lg overflow-hidden aspect-square cursor-pointer">

                            <img src="{{ $item->banner 
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />

                            <div class="absolute inset-0 bg-black/40"></div>

                            <div class="absolute inset-0 flex items-center justify-center px-2">
                                <p class="text-white text-center text-sm font-bold opacity-70 line-clamp-2">
                                    {{ $item->judul }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-layout.guest>