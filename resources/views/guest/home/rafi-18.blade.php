<x-layout.guest
    :template="json_decode(\Storage::get('website.json'))->template"
    :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'"
    :category="$category">
    <div class="w-full max-w-[1080px] mx-auto px-3 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">

        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Banner 2 --}}
        <div class="w-full max-w-[1080px] mx-auto bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-6 bg-main rounded-full"></div>
                    <h2 class="text-xl font-bold text-main">Trending</h2>
                </div>
                <a href="{{ route('article') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600">
                    Lihat Lainnya &gt;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach(array_slice($trend, 0, 3) as $item)
                <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="group">
                    <div class="p-3 border border-gray-200 rounded-lg transition-colors h-full">
                        <h3 class="font-bold text-lg group-hover:text-blue-600 line-clamp-2">
                            {{ $item->judul }}
                        </h3>
                        <div class="flex justify-between mt-1 text-gray-400 text-sm">
                            <p>{{ $item->date }}</p>
                            <p class="font-bold hover:text-blue-600 duration-300">
                                {{ $item->articles->user->name }}
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Article --}}
        <div class="w-full max-w-[1080px] mx-auto px-5 sm:px-8 pt-6">
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
                    <div class="grid grid-cols-1 gap-6">
                        @foreach(array_slice($trend, 0, 4) as $item)
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-row cursor-pointer hover:shadow-2xl transition-shadow duration-300">

                            <img src="{{ $item->banner 
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-40 h-40 object-cover flex-shrink-0" />

                            <div class="p-5 flex flex-col justify-between">
                                <div>
                                    <p class="mt-2 font-bold text-lg hover:text-blue-600 duration-300 line-clamp-1 ">
                                        {{ $item->judul }}
                                    </p>
                                    <p class="text-sm sm:text-base line-clamp-2">
                                        {!! nl2br(Str::limit(strip_tags($item->article), 200)) !!}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-400 mt-3">
                                    <span class="hover:text-blue-600 font-bold">{{ $item->articles->user->name }}</span>
                                    <span>{{ $item->date }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @include('components.section.pagination')
                </div>

                {{-- Popular --}}
                <div>
                    <div class="md:sticky top-24 space-y-4 sm:space-y-6 pb-8">

                        {{-- Title --}}
                        <div class="w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10">
                            <div class="w-1 h-7 bg-second rounded-full"></div>
                            <p class="text-xl font-bold">Artikel Populer</p>
                        </div>

                        {{-- Popular Articles --}}
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
                                    <div class="flex items-center justify-between text-xs text-gray-200">
                                        <span class="truncate hover:text-blue-600 duration-300">
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

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout.guest>