<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class=" w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
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
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />

                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-all duration-500"></div>

                        <div class="absolute bottom-4 left-4 right-4 bg-white/10 backdrop-blur-md rounded-lg p-3 border border-white/10 transform transition-transform duration-300 group-hover:-translate-y-1">
                            <p class="text-white font-bold text-sm line-clamp-2 mb-2 group-hover:text-blue-200 transition-colors">
                                {{ $item->judul }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-white/80">
                                <span class="truncate max-w-[50%]">
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
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="block relative group">
                            <img src="{{ $item->banner 
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105" />
                        </a>

                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($item->articles->articlecategory as $category)
                                <span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">
                                    {{ $category->category }}
                                </span>
                                @endforeach
                            </div>

                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h2 class="font-bold text-2xl mb-3 text-gray-900 hover:text-blue-600 transition-colors">
                                    {{ $item->judul }}
                                </h2>
                            </a>

                            <p class="text-gray-600 mb-5">
                                {!! nl2br(Str::limit(strip_tags($item->article), 150)) !!}
                            </p>

                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-medium text-gray-900">{{ $item->articles->user->name }}</span>
                                    <span class="text-sm text-gray-500">•</span>
                                    <span class="text-sm text-gray-500">{{ $item->date }}</span>
                                </div>

                                <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                                    Lihat Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

            {{-- Popular Article --}}
            <div class="md:pl-6">
                <div class="md:sticky top-24 space-y-4 sm:space-y-6">
                    {{-- Article --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4 sm:gap-8">
                        @include('components.section.popular')
                    </div>

                    {{-- Grid 4 Card Kecil --}}
                    <div class="grid grid-cols-2 gap-3 mt-6">
                        @foreach (collect($trend)->shuffle()->take(4) as $item)
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="relative group rounded-xl overflow-hidden aspect-square cursor-pointer bg-gray-100 hover:bg-gray-50 transition-all duration-300 flex items-center justify-center p-4">

                            <div class="text-center">
                                <div class="mx-auto w-10 h-10 p-2 rounded-full bg-main/10 flex items-center justify-center mb-3 group-hover:bg-main/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>

                                <p class="text-sm font-medium text-gray-800 line-clamp-1 group-hover:text-second transition-colors">
                                    {{ $item->judul }}
                                </p>

                                <div class="mt-2">
                                    <span class="inline-block px-2 py-1 text-xs text-gray-500 bg-white rounded-full border border-gray-200">
                                        {{ $item->category->name ?? 'Artikel' }}
                                    </span>
                                </div>
                            </div>

                            <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout.guest>