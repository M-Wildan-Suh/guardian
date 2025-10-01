<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full overflow-x-hidden bg-background">

        {{-- Banner --}}
        <div class="relative">
            @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)
        </div>

        {{-- Artikel --}}
        <div class="w-full max-w-[1100px] mx-auto p-4 grid grid-cols-1 md:grid-cols-4 gap-6 pb-4 mt-5">
            <div class="md:col-span-3 space-y-12 md:border-r md:border-gray-300 md:pr-6">
                {{-- Title --}}
                <div class="flex items-center gap-3 sm:gap-5">
                    <div class="w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                    <p class="text-2xl sm:text-3xl font-extrabold tracking-tight">Artikel Terbaru</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                    @foreach (collect($data)->shuffle()->take(5) as $i => $item)
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                        class="relative group rounded-2xl overflow-hidden 
                  {{ $i == 0 ? 'col-span-2 row-span-2 h-80 md:h-[500px]' : 'h-40 md:h-60' }}">

                        {{-- Gambar --}}
                        <img src="{{ $item->banner 
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent 
                        group-hover:from-black/50 transition-all duration-500"></div>

                        <div class="absolute bottom-0 left-0 right-0 p-4 md:p-6">
                            <h3 class="text-white font-bold text-lg md:text-xl line-clamp-2 group-hover:text-blue-300 transition-colors">
                                {{ $item->judul }}
                            </h3>
                            <p class="text-gray-200 text-xs md:text-sm mt-1 line-clamp-2">
                                {{ Str::limit(strip_tags($item->article), 100) }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- Artikel Utama --}}
                @foreach (array_slice($data, 0, 1) as $item)
                <div class="relative flex flex-col md:flex-row items-stretch rounded-3xl overflow-hidden shadow-xl bg-gradient-to-r from-white to-gray-50">

                    {{-- Gambar Kiri --}}
                    <div class="w-full md:w-1/2 relative">
                        <img src="{{ $item->banner 
                            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-72 md:h-full object-cover transition-transform duration-500 hover:scale-105">
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                            @foreach ($item->articles->articlecategory as $category)
                            <span class="bg-white/80 backdrop-blur-sm text-gray-800 text-xs px-3 py-1 rounded-full shadow">
                                {{ $category->category }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Konten Kanan --}}
                    <div class="flex flex-col justify-between p-8 w-full md:w-1/2">
                        <div>
                            <h2 class="font-extrabold text-2xl md:text-3xl text-gray-900 leading-snug hover:text-blue-600 transition-colors">
                                {{ $item->judul }}
                            </h2>
                            <p class="text-gray-600 mt-4 line-clamp-2">
                                {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                class="flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
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
                            class="relative group rounded-xl aspect-square cursor-pointer bg-gradient-to-br from-white to-gray-50 border border-gray-200 hover:shadow-md transition-all duration-300 p-4 flex flex-col justify-between">

                            <div>
                                <p class="text-xs font-semibold text-gray-800 line-clamp-3 group-hover:text-blue-600 transition-colors">
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