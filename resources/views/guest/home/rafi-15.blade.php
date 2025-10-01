<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full overflow-x-hidden bg-background">

        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
        </div>

        {{-- Artikel --}}
        <div class="w-full max-w-[1080px] mx-auto px-5 sm:px-8 pt-4 mt-4">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">

                {{-- Main --}}
                <div class="w-full col-span-1 md:col-span-3 space-y-4 sm:space-y-8 mb-4">

                    {{-- Title --}}
                    <div class="w-full flex justify-between items-center mt-1">
                        <div class="w-full flex items-center gap-2 sm:gap-4">
                            <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                            <p class="text-xl sm:text-3xl font-bold">Artikel Terbaru</p>
                        </div>
                    </div>

                    {{-- Article --}}
                    <div class="w-full max-w-[1080px] mx-auto rounded-xl shadow-md p-4 sm:p-6">
                        <div class="flex justify-end items-center mb-4">
                            <a href="{{ route('article') }}"
                                class="flex items-center gap-1 text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">
                                Lihat Semua Artikel
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach(array_slice($data, 0, 3) as $item)
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="group">
                                <div class="p-3 border border-gray-200 rounded-lg transition-colors h-full">
                                    <h3 class="font-bold text-lg group-hover:text-blue-600 line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>
                                </div>
                            </a>
                            @endforeach
                        </div>
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
                            <p class="text-white font-bold text-lg hover:text-blue-500 line-clamp-1">{{ $item->judul }}</p>
                            <p class="text-sm text-white line-clamp-2 mt-1">{!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                </div>

                {{-- Popular --}}
                <div>
                    <div class="md:sticky top-24 space-y-4 sm:space-y-6 pb-8">
                        {{-- Title --}}
                        <div class="w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10">
                            <div class="w-1 h-7 bg-second rounded-full"></div>
                            <p class="text-xl font-bold">Artikel Populer</p>
                        </div>

                        {{-- Popular --}}
                        <div>
                            <div class="md:sticky top-24 space-y-4 sm:space-y-6 pb-8">

                                {{-- Popular Artikel --}}
                                <div class="flex flex-col gap-4 w-full md:max-w-md">
                                    @foreach (collect($data)->shuffle()->take(5) as $item)
                                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                        class="block border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-300">

                                        <p class="font-semibold text-gray-800 line-clamp-2 hover:text-blue-600 duration-300">
                                            {{ $item->judul }}
                                        </p>
                                        <p class="text-sm sm:text-base line-clamp-2">
                                            {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                                        </p>

                                    </a>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- End popular --}}
            </div>
        </div>
    </div>
</x-layout.guest>