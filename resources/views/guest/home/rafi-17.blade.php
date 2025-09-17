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
                    
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(array_slice($trend, 0, 4) as $item)
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                        class="group relative flex flex-col md:flex-row items-start cursor-pointer 
                        p-4 md:p-6 transition-all duration-300 rounded-lg shadow-sm hover:shadow-lg hover:-translate-y-1">

                        <div class="hidden md:flex items-center w-auto mr-6 flex-shrink-0">
                            <div class="flex flex-row items-center gap-2">
                                <span class="text-2xl font-bold text-blue-600">
                                    {{ date('d', strtotime($item->date)) }}
                                </span>
                                <span class="text-xs uppercase text-gray-500 tracking-wider">
                                    {{ date('M', strtotime($item->date)) }}
                                </span>
                                <span class="text-xs text-gray-400">
                                    {{ date('Y', strtotime($item->date)) }}
                                </span>
                            </div>
                        </div>


                        <div class="w-full md:w-50 h-48 overflow-hidden rounded-lg flex-shrink-0 mr-4">
                            <img src="{{ $item->banner 
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>

                        <div class="flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 group-hover:text-blue-600 transition-colors duration-300 mb-2 line-clamp-2">
                                {{ $item->judul }}
                            </h3>

                            <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                                {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                            </p>

                            <div class="flex items-center text-xs text-gray-500">
                                <div class="flex items-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>{{ $item->articles->user->name }}</span>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $item->date }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Panah -->
                        <div class="hidden md:flex items-center justify-center ml-4 mt-4 text-blue-500 opacity-0 
                                    group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 
                                    transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </a>
                    @endforeach
                </div>
 <div class="flex justify-center mb-8 pt-4">
                <a href="{{ route('article') }}"
                   class="inline-block px-6 py-3 text-white hover:text-main bg-second text-base rounded-full font-semibold transition-colors duration-300">
                    Lihat Lainnya
                </a>
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

                                        <div class="flex items-center justify-between text-xs text-gray-500 mt-2">
                                            <span class="truncate hover:text-blue-600 duration-300">
                                                {{ $item->articles->user->name }}
                                            </span>
                                            <span class="whitespace-nowrap">
                                                {{ $item->date }}
                                            </span>
                                        </div>
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