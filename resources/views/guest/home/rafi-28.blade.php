<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class=" w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
        <div class="w-full max-w-[1280px] mx-auto px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <main class="lg:col-span-2 space-y-8 order-1 lg:order-2">
                    <h2 class="text-3xl font-semibold mb-4">Artikel Terbaru</h2>
                    @php
                        $allArticles = collect($data)->merge($trend)->shuffle();
                        $featured = $allArticles->first();
                        $others = $allArticles->skip(1)->take(4);
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        @if ($featured)
                            <article class="rounded-xl overflow-hidden shadow-md group">
                                <div class="relative">
                                    <img src="{{ $featured->banner
                                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $featured->banner
                                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        class="w-full h-64 object-cover group-hover:opacity-90 transition">

                                    <span
                                        class="absolute top-3 left-3 bg-black/70 text-white px-3 py-1 rounded text-xs">
                                        {{ $featured->articles->articlecategory[0]->category ?? 'News' }}
                                    </span>
                                </div>

                                <div class="p-4 space-y-2">
                                    <a href="{{ route('detail', ['slug' => $featured->slug]) }}">
                                        <h3 class="text-xl font-bold group-hover:text-blue-600 transition">
                                            {{ $featured->judul }}
                                        </h3>
                                    </a>
                                    <p class="text-sm text-gray-600 line-clamp-3">
                                        {!! Str::limit(strip_tags($featured->article), 120) !!}
                                    </p>
                                </div>
                            </article>
                        @endif

                        <div class="space-y-4">
                            @foreach ($others as $item)
                                <div class="grid grid-cols-3 gap-3 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                        <img src="{{ $item->banner
                                            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                            class="w-full h-20 object-cover rounded-md">
                                    </a>

                                    <div class="col-span-2">
                                        <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                            <h4
                                                class="font-semibold text-sm line-clamp-2 hover:text-blue-600 transition">
                                                {{ $item->judul }}
                                            </h4>
                                            <p class="text-sm text-gray-600 line-clamp-2">
                                                {!! Str::limit(strip_tags($featured->article), 120) !!}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    @php
                        $gridTwo = $allArticles->skip(5)->take(6);
                    @endphp

                    <div class="grid sm:grid-cols-2 gap-6">
                        @foreach ($gridTwo as $item)
                            <article
                                class="flex flex-col space-y-2 rounded-lg overflow-hidden shadow hover:shadow-lg transition">

                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <img src="{{ $item->banner
                                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        class="w-full h-40 object-cover">
                                </a>

                                <div class="px-2 pb-4">
                                    <span class="text-xs text-blue-600 font-semibold block mb-1">
                                        {{ $item->articles->articlecategory[0]->category ?? 'General' }}
                                    </span>

                                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                        <h3 class="font-semibold text-base line-clamp-2 hover:text-blue-600 transition">
                                            {{ $item->judul }}
                                        </h3>
                                    </a>

                                    <p class="text-sm text-gray-600 line-clamp-3 mt-1">
                                        {!! Str::limit(strip_tags($item->article), 100) !!}
                                    </p>

                                </div>

                            </article>
                        @endforeach
                    </div>


                    @include('components.section.pagination')

                </main>

                <aside class="lg:col-span-1 order-2 lg:order-3">
                    <div class="lg:sticky top-24 space-y-4">
                        <h2 class="text-lg font-bold">Artikel Populer</h2>

                        @foreach ($trend as $item)
                            <div class="grid grid-cols-5 gap-3 hover:bg-gray-50 p-2 rounded-md transition">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <img src="{{ $item->banner
                                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        class="col-span-2 aspect-square object-cover rounded-md">
                                </a>

                                <div class="col-span-3">
                                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                        <p class="text-sm line-clamp-2">
                                            {{ $item->judul }}
                                        </p>
                                        <p class="text-sm text-gray-600 line-clamp-2">
                                            {!! Str::limit(strip_tags($featured->article), 120) !!}
                                        </p>
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
