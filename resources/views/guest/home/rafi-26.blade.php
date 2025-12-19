<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    <div class="w-full px-4 sm:px-8 py-8 sm:py-12">

        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        <div class="w-full max-w-[1080px] mx-auto mt-10">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        Artikel Terbaru
                    </h2>
                    <div class="w-16 h-1 bg-main mt-2 rounded-full"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-8">
                        @php $big1 = $trend[0]; @endphp

                        <a href="{{ route('detail', $big1->slug) }}" class="block">
                            <img src="{{ $big1->banner
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $big1->banner
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                class="w-full h-56 sm:h-64 object-cover rounded-lg" />

                            <div class="mt-3">
                                <span class="bg-black text-white px-2 py-1 rounded text-xs">
                                    {{ $big1->articles->articlecategory[0]->category ?? 'Category' }}
                                </span>

                                <h2 class="mt-3 text-2xl font-bold text-gray-900 hover:text-main transition">
                                    {{ $big1->judul }}
                                </h2>

                                <p class="text-gray-600 mt-1 text-sm">
                                    {{ strip_tags(Str::limit($big1->article, 120)) }}
                                </p>
                            </div>
                        </a>

                        @foreach (array_slice($trend, 1, 3) as $item)
                            <a href="{{ route('detail', $item->slug) }}" class="flex gap-4 group">
                                <img src="{{ $item->banner
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    class="w-28 h-20 object-cover rounded-md" />

                                <div class="flex flex-col justify-center">
                                    <span class="bg-black text-white px-2 py-1 rounded text-[10px] w-fit">
                                        {{ $item->articles->articlecategory[0]->category ?? 'Category' }}
                                    </span>

                                    <h3
                                        class="font-semibold text-gray-800 leading-snug mt-1 hover:text-main transition">
                                        {{ $item->judul }}
                                    </h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="space-y-8">

                        @php $big2 = $data[4] ?? null; @endphp

                        @if ($big2)
                            <a href="{{ route('detail', $big2->slug) }}" class="block">
                                <img src="{{ $big2->banner
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $big2->banner
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    class="w-full h-56 sm:h-64 object-cover rounded-lg" />

                                <div class="mt-3">
                                    <span class="bg-black text-white px-2 py-1 rounded text-xs">
                                        {{ $big2->articles->articlecategory[0]->category ?? 'Category' }}
                                    </span>

                                    <h2 class="mt-3 text-2xl font-bold text-gray-900 hover:text-main transition">
                                        {{ $big2->judul }}
                                    </h2>

                                    <p class="text-gray-600 mt-1 text-sm">
                                        {{ strip_tags(Str::limit($big2->article, 120)) }}
                                    </p>
                                </div>
                            </a>
                        @endif

                        @foreach (array_slice($data, 5, 3) as $item)
                            <a href="{{ route('detail', $item->slug) }}" class="flex gap-4 group">
                                <img src="{{ $item->banner
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    class="w-28 h-20 object-cover rounded-md" />

                                <div class="flex flex-col justify-center">
                                    <span class="bg-black text-white px-2 py-1 rounded text-[10px] w-fit">
                                        {{ $item->articles->articlecategory[0]->category ?? 'Category' }}
                                    </span>

                                    <h3
                                        class="font-semibold text-gray-800 leading-snug mt-1 hover:text-main transition">
                                        {{ $item->judul }}
                                    </h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <aside class="lg:col-span-1">
                    <h2 class="uppercase text-sm font-bold tracking-wider border-b pb-2">
                        Artikel Populer
                    </h2>

                    <div class="mt-5 flex flex-col divide-y">
                        @foreach (collect($data)->shuffle()->take(6) as $item)
                            <a href="{{ route('detail', $item->slug) }}" class="flex items-center gap-4 py-3 group">
                                <img src="{{ $item->banner
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    class="w-20 h-16 object-cover rounded-md hover:scale-105 transition-transform" />

                                <div class="flex flex-col">
                                    <h3 class="text-sm font-semibold text-black hover:text-main leading-tight">
                                        {{ $item->judul }}
                                    </h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </aside>

            </div>

            <div class="flex justify-center mt-6">
                <a href="{{ route('article') }}">
                    <button
                        class="px-6 py-2 flex items-center gap-2 rounded-full text-sm font-medium text-white bg-main hover:bg-main/30 shadow-md duration-300">
                        <span>Lihat Lainnya</span>
                        <div class="w-4 aspect-square">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </button>
                </a>
            </div>
        </div>
    </div>
</x-layout.guest>
