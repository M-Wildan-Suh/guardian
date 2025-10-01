@foreach ($trend as $item)
    <div class=" grid grid-cols-5 sm:grid-cols-4 gap-2">
        <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
            <div class=" w-full aspect-square rounded-md bg-white overflow-hidden">
                <img src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    class=" w-full h-full object-cover" alt="">
            </div>
        </a>
        <div class=" col-span-4 sm:col-span-3 flex flex-col justify-between">
            <a href="{{ route('detail', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
                <p class=" line-clamp-2 text-sm h-10">{{ $item->judul }}</p>
            </a>
            <!-- <div class="flex flex-row justify-between text-xs">
                <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                    aria-label="{{ $item->judul }}">
                    <p class="font-bold text-neutral-600 hover:text-blue-600 duration-300">
                        {{ $item->articles->user->name }}</p>
                </a>
            </div> -->
        </div>
    </div>
@endforeach
