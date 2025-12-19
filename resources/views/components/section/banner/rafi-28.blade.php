<div class="w-full flex justify-center px-4">
    <div class="w-full max-w-[1200px] grid grid-cols-1 md:grid-cols-3 gap-4">

        @if (isset($trend[0]))
            @php $item = $trend[0]; @endphp
            <div class="relative rounded-lg overflow-hidden md:col-span-2 h-[300px] sm:h-[400px] md:h-[450px]">
                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-full object-cover brightness-[0.65]">
                </a>

                <div class="absolute inset-0 p-6 flex flex-col justify-end 
                    bg-black/40 text-white">

                    <span class="text-xs font-semibold uppercase">
                        {{ $item->articles->articlecategory[0]->category ?? 'Category' }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-bold leading-tight mb-3">
                        {{ $item->judul }}
                    </h2>
                    <p class="text-sm text-white line-clamp-2">
                        {!! Str::limit(strip_tags($item->article), 120) !!}
                    </p>

                </div>
            </div>
        @endif

        @if (isset($trend[1]))
            @php $item = $trend[1]; @endphp
            <div class="relative rounded-lg overflow-hidden h-[300px] sm:h-[400px] md:h-[450px]">
                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                    <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                        class="w-full h-full object-cover brightness-[0.65]">
                </a>

                <div class="absolute inset-0 p-6 flex flex-col justify-end 
                    bg-black/40 text-white">

                    <span class="text-xs font-semibold uppercase">
                        {{ $item->articles->articlecategory[0]->category ?? 'Category' }}
                    </span>
                    <h2 class="text-xl sm:text-2xl font-bold leading-tight mb-3">
                        {{ $item->judul }}
                    </h2>
                    <p class="text-sm text-white line-clamp-2">
                        {!! Str::limit(strip_tags($item->article), 120) !!}
                    </p>

                </div>
            </div>
        @endif



        @foreach ([2, 3, 4] as $i)
            @if (isset($trend[$i]))
                @php $item = $trend[$i]; @endphp

                <div class="relative rounded-lg overflow-hidden h-[200px]">
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            class="w-full h-full object-cover brightness-[0.7]">
                    </a>

                    <div
                        class="absolute inset-0 p-4 flex flex-col justify-end 
                        bg-gradient-to-t from-black/60 via-black/20 to-transparent text-white">

                        <span class="text-[10px] font-semibold uppercase mt-1 opacity-80">
                            {{ $item->articles->articlecategory[0]->category ?? 'Category' }}
                        </span>
                        <h2 class="text-base font-bold leading-tight line-clamp-2 mb-1">
                            {{ $item->judul }}
                        </h2>
                        <p class="text-sm text-white line-clamp-2">
                            {!! Str::limit(strip_tags($item->article), 120) !!}
                        </p>

                    </div>
                </div>
            @endif
        @endforeach

    </div>
</div>
