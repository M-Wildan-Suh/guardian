<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class=" w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
        <div class="w-full max-w-[1280px] mx-auto px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                {{-- Kiri --}}
                <aside class="md:col-span-1">
                    <div class="md:sticky top-24 space-y-4">
                        <h2 class="text-lg font-bold">Kategori</h2>

                        <div class="flex flex-wrap gap-2">
                            @php
                            $mixed = collect(array_slice($data, 0, 2))
                            ->merge(collect(array_slice($trend, 0, 2)))
                            ->shuffle(); // optional: acak urutan
                            @endphp

                            @foreach ($mixed as $item)
                            @foreach ($item->articles->articlecategory as $category)
                            <a href="{{ route('category', ['category' => $category->slug]) }}">
                                <div class="py-1 px-2 bg-main text-white text-sm rounded-full">
                                    {{ $category->category }}
                                </div>
                            </a>
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </aside>

                {{-- Tengah --}}
                @php
                // Gabungkan dua koleksi dan acak
                $allArticles = collect($data)->merge($trend)->shuffle();

                // Ambil artikel pertama sebagai unggulan
                $featured = $allArticles->first();

                // Ambil sisanya untuk grid
                $others = $allArticles->skip(1)->take(6);
                @endphp

                <main class="md:col-span-2 space-y-6">
                    <h2 class="text-lg font-bold">Artikel Pilihan</h2>

                    {{-- Artikel Unggulan --}}
                    @if($featured)
                    <article class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                        <img src="{{ $featured->banner 
                            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $featured->banner 
                            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $featured->judul }}"
                            class="w-full h-80 object-cover" />

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                        <div class="absolute bottom-6 left-6 text-white space-y-2">
                            <span class="bg-blue-600 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $featured->articles->articlecategory[0]->category ?? 'Berita' }}
                            </span>
                            <a href="{{ route('detail', ['slug' => $featured->slug]) }}">
                                <h3 class="text-2xl font-bold leading-snug hover:text-blue-300 transition-colors">
                                    {{ $featured->judul }}
                                </h3>
                            </a>
                            <p class="text-sm opacity-90 line-clamp-2">{!! Str::limit(strip_tags($featured->article), 100) !!}</p>
                        </div>
                    </article>
                    @endif

                    {{-- Grid Artikel Lainnya --}}
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @foreach ($others as $item)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden transition-all duration-300">
                            <img src="{{ $item->banner 
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}" class="h-32 w-full object-cover" />

                            <div class="p-3 space-y-1">
                                <span class="text-xs text-blue-600 font-semibold">
                                    {{ $item->articles->articlecategory[0]->category ?? 'Umum' }}
                                </span>
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <h4 class="font-semibold text-sm line-clamp-2 hover:text-blue-600">
                                        {{ $item->judul }}
                                    </h4>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @include('components.section.pagination')
                </main>

                {{-- Kanan --}}
                <aside class="md:col-span-1">
                    <div class="md:sticky top-24 space-y-4">
                        <h2 class="text-lg font-bold">Artikel Populer</h2>
                        @foreach ($trend as $item)
                        <div class="grid grid-cols-5 sm:grid-cols-4 gap-2">
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <div class="w-full aspect-square rounded-md bg-white overflow-hidden">
                                    <img src="{{ $item->banner 
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        class="w-full h-full object-cover" alt="">
                                </div>
                            </a>
                            <div class="col-span-4 sm:col-span-3 flex flex-col justify-between">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <p class="line-clamp-2 text-sm h-10">{{ $item->judul }}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>

    </div>
</x-layout.guest>