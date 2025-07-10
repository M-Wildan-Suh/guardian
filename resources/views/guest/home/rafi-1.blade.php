<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class=" w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
        <div class=" w-full max-w-[1080px] mx-auto">
            <div class=" w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
                {{-- Main --}}
                <div class=" w-full col-span-1 md:col-span-4 space-y-4 sm:space-y-8">
                    {{-- Title --}}
                    <div class=" w-full flex justify-between items-center">
                        <div class=" w-full flex items-center gap-2 sm:gap-4">
                            <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
                            <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
                        </div>
                        <a href="{{route('article')}}">
                            <button class=" px-4 py-2 flex items-center gap-1 border rounded-full text-nowrap text-xs text-neutral-600 border-neutral-600 hover:text-main hover:border-main duration-300">
                                <p>Lihat Lainnya</p>
                                <div class=" w-3 aspect-square">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" data-name="Layer 2" fill="currentColor" class="fill-000000"></path>
                                    </svg>
                                </div>
                            </button>
                        </a>
                    </div>

                    {{-- Article --}}
                    <div class="w-full grid grid-cols-2 md:grid-cols-4 gap-4">
                        @forelse ($data as $item)
                        @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                        @empty
                        <div class=" col-span-2 md:col-span-4 w-full flex justify-center text-center">
                            <p class=" text-neutral-600">Article tidak ditemukan</p>
                        </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @include('components.section.pagination')
                </div>


            </div>
        </div>
        {{-- Article --}}
        <div class=" w-full max-w-[1080px] mx-auto">
            <div class=" w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
                {{-- Main --}}
                <div class=" w-full col-span-1 md:col-span-4 space-y-4 sm:space-y-8">
                    {{-- Title --}}
                    <div class=" w-full flex justify-between items-center">
                        <div class=" w-full flex items-center gap-2 sm:gap-4">
                            <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-main rounded-full"></div>
                            <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Populer</p>
                        </div>
                    </div>

                    {{-- Article --}}
                    <div class="w-full grid grid-cols-2 md:grid-cols-4 gap-4">
                        @forelse (array_slice($trend, 0, 4) as $item)
                            @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                        @empty
                            <div class=" col-span-2 md:col-span-4 w-full flex justify-center text-center">
                                <p class=" text-neutral-600">Article tidak ditemukan</p>
                            </div>
                        @endforelse
                    </div>

                </div>


            </div>
        </div>
    </div>
</x-layout.guest>