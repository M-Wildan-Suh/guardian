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
                        <h2 class="text-lg font-bold">Artikel</h2>
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

                {{-- Tengah --}}
                <main class="md:col-span-2 space-y-6">
                    <h2 class="text-lg font-bold">Artikel Utama</h2>
                    @foreach ($data as $item)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-md duration-300">
                        <div class="relative">
                            <img src="{{ $item->banner 
                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}" class="w-full h-56 object-cover mx-auto" />
                            <span class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $item->articles->articlecategory[0]->category ?? 'Artikel' }}
                            </span>
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                <h3 class="text-xl font-semibold line-clamp-2 mt-2">{{ $item->judul }}</h3>
                            </a>
                            <p class="text-sm font-semibold text-gray-500 mt-2 line-clamp-2">{!! Str::limit(strip_tags($item->article), 80) !!}</p>
                        </div>
                    </div>
                    @endforeach

                    {{-- Pagination --}}
                    @include('components.section.pagination')
                </main>

                {{-- Kanan --}}
                <aside class="md:col-span-1">
                    <div class="md:sticky top-24 space-y-4">
                        <h2 class="text-lg font-bold">Artikel Populer</h2>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4">
                                @foreach (collect($data)->shuffle()->take(4) as $item)
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                    class="relative group rounded-xl overflow-hidden h-32 w-full cursor-pointer">

                                    <img src="{{ $item->banner 
                                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />

                                    <div class="absolute inset-0 bg-black/60 transition-opacity duration-300 group-hover:bg-black/30"></div>

                                    <div class="absolute bottom-4 right-4 flex flex-col justify-center text-white space-y-1 max-w-[70%] text-right">
                                        <p class="line-clamp-2 font-bold hover:text-blue-600 duration-300 text-sm">
                                            {{ $item->judul }}
                                        </p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>


    </div>
</x-layout.guest>