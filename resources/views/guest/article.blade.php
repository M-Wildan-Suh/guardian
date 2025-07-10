<x-layout.guest title="Artikel{{$currentPage ? ' - Page ' . $currentPage : ''}}" :category="$category">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class=" w-full py-6 sm:py-10 px-4 sm:px-6 space-y-8 sm:space-y-12">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-4 sm:space-y-6">
                    {{-- Title --}}
                    <div class=" w-full flex items-center gap-2 sm:gap-4">
                        <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                        <p class=" text-xl sm:text-3xl font-bold text-center capitalize">{{$title}}</p>
                    </div>

                    {{-- Article --}}
                    <div class=" w-full grid grid-cols-2 md:grid-cols-4 gap-4">
                        @forelse ($data as $item)
                            @include('components.section.article.'.json_decode(\Storage::get('website.json'))->template)
                        @empty
                            <div class=" col-span-2 md:col-span-4 w-full flex justify-center text-center">
                                <p class=" text-neutral-600">Article tidak ditemukan</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if ($data)
                        @include('components.section.pagination')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>