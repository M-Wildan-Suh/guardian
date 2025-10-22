<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
        <section class="w-full bg-background py-16">
            <div class="max-w-[1200px] mx-auto px-4">
                {{-- Header --}}
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-2 h-12 bg-main rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-bold bg-clip-text text-second">
                        Artikel Populer
                    </h2>
                </div>

                {{-- Artikel populer --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach (array_slice($trend, 0, 6) as $item)
                        <div
                            class="group relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-500 ease-out">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <div class="overflow-hidden">
                                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500 ease-out" />
                                </div>
                            </a>
                            <div
                                class="p-5 flex flex-col justify-between flex-grow bg-gradient-to-t from-gray-50 to-white">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <h3
                                        class="font-semibold text-lg text-gray-800 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>
                                </a>
                            </div>

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="top-24 pb-8">
                    {{-- Title --}}
                    <div class="w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10 mb-6 mt-5">
                        <div class="w-1 h-7 bg-main rounded-full"></div>
                        <p class="text-3xl sm:text-4xl font-bold bg-clip-text">Artikel Terbaru</p>
                    </div>

                    {{-- Popular Artikel Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach (collect($data)->shuffle()->take(6) as $item)
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                class="group block border border-gray-200 rounded-xl overflow-hidden p-5 bg-white shadow-sm hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2">

                                <p
                                    class="font-semibold text-gray-800 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $item->judul }}
                                </p>
                                <p class="text-sm sm:text-base text-gray-600 mt-2 line-clamp-2">
                                    {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                                </p>

                                {{-- Hover underline animation --}}
                                <div class="mt-3 w-0 group-hover:w-full h-0.5 bg-blue-500 transition-all duration-500">
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Button --}}
                    <div class="flex justify-center mt-10">
                        <a href="{{ route('article') }}">
                            <button
                                class="relative px-8 py-3 flex items-center gap-3 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 shadow-lg transition-all duration-500 group overflow-hidden">
                                <span class="relative z-10">Lihat Lainnya</span>
                                <div
                                    class="w-4 aspect-square relative z-10 transform group-hover:translate-x-1 transition-transform duration-300">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </div>

                                {{-- Glow efek di belakang tombol --}}
                                <span
                                    class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-xl rounded-full"></span>
                            </button>
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </div>
</x-layout.guest>
