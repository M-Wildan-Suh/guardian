<div class="w-full max-w-[1080px] mx-auto grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-3">
    {{-- Kolom kiri: Banner utama --}}
    @php $item = $data[2] ?? null; @endphp
    @if ($item)
        <div class="col-span-2 row-span-3 relative rounded-lg overflow-hidden h-[420px] md:h-[500px]">
            <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-black/50 hover:bg-black/30 flex items-end p-6">
                <div class="text-white space-y-2">
                    {{-- kategori --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach ($item->articles->articlecategory as $category)
                            <a href="{{ route('category', ['category' => $category->slug]) }}">
                                <div
                                    class="py-0.5 px-3 bg-white text-black text-xs font-semibold rounded-full uppercase">
                                    {{ $category->category }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                    {{-- judul --}}
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <h2 class="text-2xl md:text-4xl font-bold leading-tight drop-shadow-md">
                            {{ $item->judul }}
                        </h2>
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Kolom kanan atas: 3 card kecil --}}
    @foreach (array_slice($trend, 0, 3) as $item)
        <div class="relative h-[160px] overflow-hidden rounded-lg">
            <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                class="w-full h-full object-cover hover:scale-105 duration-300" alt="">
            <div class="absolute inset-0 bg-black/50 hover:bg-black/30 flex items-end p-4">
                <div class="text-white space-y-1">
                    {{-- kategori --}}
                    <div class="flex flex-wrap gap-1">
                        @foreach ($item->articles->articlecategory as $category)
                            <a href="{{ route('category', ['category' => $category->slug]) }}">
                                <div
                                    class="py-0.5 px-2 bg-white text-black text-xs font-semibold rounded-full uppercase">
                                    {{ $category->category }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                    {{-- judul --}}
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <p class="text-md sm:text-base font-semibold leading-tight line-clamp-2">
                            {{ $item->judul }}
                        </p>
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Baris bawah: 3 card tambahan --}}
    @foreach (array_slice($data, 0, 3) as $item)
        <div class="relative h-[180px] overflow-hidden rounded-lg">
            <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                class="w-full h-full object-cover hover:scale-105 duration-300" alt="">
            <div class="absolute inset-0 bg-black/50 hover:bg-black/30 flex items-end p-4">
                <div class="text-white space-y-1">
                    {{-- kategori --}}
                    <div class="flex flex-wrap gap-1">
                        @foreach ($item->articles->articlecategory as $category)
                            <a href="{{ route('category', ['category' => $category->slug]) }}">
                                <div
                                    class="py-0.5 px-2 bg-white text-black text-xs font-semibold rounded-full uppercase">
                                    {{ $category->category }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                    {{-- judul --}}
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <p class="text-md sm:text-base font-semibold leading-tight line-clamp-2">
                            {{ $item->judul }}
                        </p>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
