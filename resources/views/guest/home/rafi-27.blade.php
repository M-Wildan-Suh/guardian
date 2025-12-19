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

                {{-- Artikel Besar Utama --}}
                @foreach (array_slice($data, 0, 1) as $item)
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">

                        {{-- Gambar Kiri --}}
                        <div class="w-full md:w-1/2 relative">
                            <img src="{{ $item->banner
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                class="w-full h-64 md:h-full object-cover transition duration-500 hover:scale-105"
                                alt="">

                            <div class="absolute item-4 left-4 flex flex-wrap gap-2">
                                @foreach ($item->articles->articlecategory as $category)
                                    <span
                                        class="bg-white/80 backdrop-blur-sm text-gray-800 text-xs px-3 py-1 rounded-full shadow">
                                        {{ $category->category }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 p-8 flex flex-col justify-between">
                            <div>
                                <h2
                                    class="text-2xl md:text-3xl font-extrabold text-gray-900 hover:text-blue-600 transition">
                                    {{ $item->judul }}
                                </h2>
                                <p class="text-gray-600 mt-4 leading-relaxed line-clamp-4">
                                    {!! nl2br(Str::limit(strip_tags($item->article), 180)) !!}
                                </p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                    class="flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition">
                                    Baca Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    @foreach (collect($data)->shuffle()->take(4) as $item)
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="relative group rounded-2xl overflow-hidden h-44 md:h-56 shadow-lg">

                            {{-- Gambar --}}
                            <img src="{{ $item->banner
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-110">

                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-black/40">
                            </div>

                            {{-- Judul --}}
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="text-white font-bold text-sm md:text-base leading-tight line-clamp-2">
                                    {{ $item->judul }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach (array_slice($data, 0, 6) as $item)
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="relative group overflow-hidden rounded-xl shadow-lg cursor-pointer transition-transform duration-300 hover:scale-105">

                            <img src="{{ $item->banner
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />

                            <div class="absolute inset-0 bg-black/35 flex flex-col justify-end p-5">
                                <p class="text-white font-bold text-lg hover:text-blue-500 line-clamp-1">
                                    {{ $item->judul }}</p>
                                <p class="text-sm text-white line-clamp-2 mt-1">{!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                @include('components.section.pagination')
            </div>

            <div class="relative">
                <div class=" w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10 pb-4">
                    <div class=" w-1 h-7 bg-second rounded-full"></div>
                    <p class=" text-xl font-bold text-center">Artikel Populer</p>
                </div>

                @php $item = $data[0]; @endphp

                <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                    class="block relative rounded-2xl overflow-hidden shadow-lg group h-56 md:h-64">

                    <img src="{{ $item->banner
                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-black/40 hover:bg-black/20"></div>

                    {{-- Konten --}}
                    <div class="absolute bottom-0 p-5 text-white space-y-2">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($item->articles->articlecategory as $category)
                                <span class="bg-white/20 backdrop-blur-sm text-xs px-2 py-1 rounded">
                                    {{ $category->category }}
                                </span>
                            @endforeach
                        </div>

                        <h3 class="text-xl font-extrabold line-clamp-2 group-hover:text-blue-300 transition">
                            {{ $item->judul }}
                        </h3>

                        <p class="text-sm text-gray-200 line-clamp-2">
                            {{ Str::limit(strip_tags($item->article), 100) }}
                        </p>
                    </div>

                </a>
                <div class="space-y-4 mt-6">

                    @foreach (array_slice($trend, 1, 10) as $item)
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="flex gap-4 items-start bg-white rounded-xl p-3 shadow-sm hover:shadow-md transition cursor-pointer group">

                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->banner
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>

                            {{-- Konten Kanan --}}
                            <div class="flex-1 min-w-0">

                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach ($item->articles->articlecategory as $category)
                                        <span class="text-sm font-semibold text-main">
                                            {{ $category->category }}
                                        </span>
                                    @endforeach
                                </div>

                                <h4
                                    class="font-bold text-gray-900 leading-snug line-clamp-1 group-hover:text-blue-600 transition">
                                    {{ $item->judul }}
                                </h4>

                                <p class="text-gray-600 text-sm mt-1 line-clamp-1">
                                    {{ Str::limit(strip_tags($item->article), 80) }}
                                </p>
                            </div>

                        </a>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</x-layout.guest>
