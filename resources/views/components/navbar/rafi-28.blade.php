{{-- Navigation --}}
<div class="sticky top-0 z-40" x-data="{open : false}">
    <div class=" relative grid grid-col-3 w-full bg-white px-4 md:px-8 py-4 z-40 shadow-md shadow-black/10">
        <div class=" w-full max-w-[1080px] mx-auto flex items-center gap-10 justify-between">
            <a href="{{route('home')}}">
                <div class=" min-w-32 h-10 sm:h-12 flex items-center overflow-hidden">
                    @if ((optional(json_decode(\Storage::get('website.json'), true))['type'] ?? null) === 'teks')
                        <p class=" text-3xl sm:text-4xl font-bold">{{json_decode(\Storage::get('website.json'), true)['title']}}</p>
                    @elseif ((optional(json_decode(\Storage::get('website.json'), true))['type'] ?? null) === 'image')
                        <img src="{{asset('storage/images/'. json_decode(\Storage::get('website.json'), true)['image'])}}" class=" object-contain max-h-full max-w-full" alt="">
                    @endif
                </div>
            </a>
            <div class=" hidden md:block flex-grow">
                <form action="{{route('article')}}" method="get">
                    <div class=" flex items-center justify-between h-10 bg-white">
                        <input type="text" name="search" value="{{ request('search') }}" class=" min-w-0 sm:flex-grow h-10 text-sm px-4 sm:px-6 border-r-0 rounded-l-full focus:border-main focus:ring-0" placeholder="Cari Artikel....">
                        <button aria-label="Cari" class=" px-4 sm:px-6 bg-main hover:bg-third rounded-r-full text-white duration-300 h-10">
                            <div class=" w-[18px] aspect-square overflow-hidden">
                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-search" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            <div class=" hidden md:flex flex-row gap-6 items-center text-neutral-500">
                <x-navbar.button.type-a title="Beranda" :route="route('home')" :active="['home']" :mobile="false" />
                <div x-data="{ article : false }" class=" relative">
                    <button @click="article = !article" class="{{ request()->routeIs('article', 'article.page', 'author', 'author.page', 'category', 'category.page', 'tag', 'tag.page', 'detail') ? 'text-white bg-second' : 'text-black hover:text-white hover:bg-second'}} px-5 py-1.5 rounded-full font-semibold text-base duration-300" aria-label="Artikel">Artikel</button>
                    <div x-show="article" class=" absolute top-full left-0 bg-white py-2 rounded-md shadow-md shadow-black/20 text-sm">
                        <div class=" max-h-36 overflow-auto flex flex-col gap-1">
                            <a href="{{route('article')}}" class=" w-full  text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">Artikel Terbaru</a>
                            @foreach ($category as $item)
                                <a href="{{route('category', ['category' => $item->slug])}}" class=" w-full  text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">{{$item->category}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <x-navbar.button.type-a title="Kontak" route="{{ request()->routeIs('detail') ? route('home') : '' }}#kontak" :active="null" :mobile="false" />
            </div>
            <div class=" h-8 sm:h-10 block sm:hidden">
                <button @click="open = !open" class="w-8 h-8 p-2 bg-second rounded-md text-white flex flex-col justify-between items-center relative">
                    <span :class="open ? 'w-0 translate-y-2.5' : 'w-full'" class=" h-0.5 bg-white rounded-full duration-300"></span>
                    <span :class="open ? 'w-0' : 'w-full'" class=" h-0.5 bg-white rounded-full duration-300"></span>
                    <span :class="open ? 'w-0 -translate-y-2.5' : 'w-full'" class=" h-0.5 bg-white rounded-full duration-300"></span>
                    <span :class="open ? 'w-5' : 'w-0'" class=" absolute h-0.5 bg-white rounded-full duration-300 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                    <span :class="open ? 'w-5' : 'w-0'" class=" absolute h-0.5 bg-white rounded-full duration-300 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45"></span>
                </button>
            </div>
        </div>
    </div>
    <div :class="{' top-[70px] sm:top-20': open, '-translate-y-full top-0': !open}" class=" fixed flex md:hidden flex-col bg-white w-full left-0 justify-center gap-4 font-semibold text-neutral-600 pt-2 px-4 pb-4 duration-300 z-30">
        <x-navbar.button.type-a title="Beranda" :route="route('home')" :active="['home']" :mobile="true" />
        <div x-data="{ article : false }" class=" relative">
            <button @click="article = !article" class="{{ request()->routeIs('article', 'article.page', 'author', 'author.page', 'category', 'category.page', 'tag', 'tag.page', 'detail') ? 'text-white bg-second' : 'text-black hover:text-white hover:bg-second'}} w-full py-2 rounded-full font-semibold text-sm duration-300" aria-label="Artikel">Artikel</button>
            <div x-show="article" class=" max-h-36 overflow-auto py-2 flex flex-col gap-1 text-sm">
                <a href="{{route('article')}}" class=" w-full  text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">Artikel Terbaru</a>
                @foreach ($category as $item)
                    <a href="{{route('category', ['category' => $item->slug])}}" class=" w-full  text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">{{$item->category}}</a>
                @endforeach
            </div>
        </div>
        <x-navbar.button.type-a title="Kontak" :route="null" :active="null" :mobile="true" />
        <form action="{{route('article')}}" method="get">
            <div class=" flex items-center justify-between h-10 bg-white">
                <input type="text" name="search" value="{{ request('search') }}" class="flex-grow h-10 text-sm px-4 sm:px-6 border-r-0 rounded-l-full focus:border-main focus:ring-0" placeholder="Cari Artikel....">
                <button class=" px-6 bg-main hover:bg-third rounded-r-full text-white duration-300 h-10" aria-label="cari">
                    <div class=" w-[18px] aspect-square overflow-hidden">
                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-search" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg>
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>