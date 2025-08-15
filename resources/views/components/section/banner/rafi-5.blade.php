<div class="swiper homeBannerSwiper w-full py-6">
    <div class="swiper-wrapper">
      @foreach ($randomTrend as $item)
      <div class="swiper-slide relative rounded-xl overflow-hidden">
        {{-- Gambar --}}
        <a href="{{ route('detail', ['slug' => $item->slug]) }}">
          <img src="{{ $item->banner 
                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
            alt="{{ $item->judul }}"
            class="w-full h-64 object-cover" />
        </a>

        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-4">
          {{-- Kategori --}}
          <div class="mb-2">
            @foreach ($item->articles->articlecategory as $category)
            <a href="{{ route('category', ['category' => $category->slug]) }}"
              class="bg-main text-white hover:text-blue-500 text-sm font-semibold px-3 py-1">
              {{ $category->category }}
            </a>
            @endforeach
          </div>
          {{-- Judul --}}
          <a href="{{ route('detail', ['slug' => $item->slug]) }}"
            class="text-white hover:text-blue-500 text-lg font-bold line-clamp-2">
            {{ Str::limit($item->judul, 80) }}
          </a>
          <div class="text-gray-200  hover:text-blue-500 text-xs mt-1">
              <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                class="font-semibold">
                {{ $item->articles->user->name }}
              </a>, {{ $item->date }}
          </div>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="swiper-pagination"></div>
  </div>