<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">

    <div class="w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Article Section --}}
        <div class="w-full flex justify-center">
            <div class="w-full max-w-[1200px] mx-auto px-6 sm:px-8 lg:px-10">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                    {{-- Artikel Terbaru --}}
                    <main class="md:col-span-3 space-y-8">
                        <h2 class="text-3xl font-bold border-b-2 border-black inline-block pb-1">
                            Artikel Terbaru
                        </h2>

                        @foreach (array_slice($data, 0, 4) as $item)
                            <div
                                class="flex flex-col md:flex-row bg-white rounded-lg shadow-sm hover:shadow-md overflow-hidden transition duration-300">
                                {{-- Gambar kiri --}}
                                <div class="md:w-2/5 w-full">
                                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                        <img src="{{ $item->banner
                                            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                            alt="{{ $item->judul }}" class="w-full h-52 md:h-full object-cover" />
                                    </a>
                                </div>

                                {{-- Konten kanan --}}
                                <div class="md:w-3/5 w-full p-6 flex flex-col justify-center space-y-3">
                                    {{-- Kategori --}}
                                    <a href="{{ route('category', ['category' => $item->articles->articlecategory[0]->slug ?? '#']) }}"
                                        class="text-main text-sm font-semibold">
                                        {{ $item->articles->articlecategory[0]->category ?? 'Artikel' }}
                                    </a>

                                    {{-- Judul --}}
                                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                        <h3
                                            class="text-xl font-bold text-gray-800 hover:text-blue-500 transition-colors duration-200 leading-snug">
                                            {{ $item->judul }}
                                        </h3>
                                    </a>

                                    {{-- Deskripsi --}}
                                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-2">
                                        {!! Str::limit(strip_tags($item->article), 120) !!}
                                    </p>

                                    {{-- Tombol --}}
                                    <div>
                                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                            class="inline-block bg-main hover:bg-green-700 text-white text-md font-semibold px-4 py-2 rounded-md transition duration-200">
                                            Lihat Selengkapnya »
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Pagination --}}
                        @include('components.section.pagination')
                    </main>

                    {{-- Sidebar Kanan --}}
                    <aside class="md:col-span-1">
                        <div class="md:sticky top-24 space-y-8">

                            {{-- Medsos --}}
                            <div class="flex flex-col items-center text-center space-y-4">
                                <div class="flex items-center w-full justify-center gap-3">
                                    <span class="flex-1 h-px bg-main"></span>
                                    <h2 class="text-xs font-semibold uppercase tracking-wider text-gray-700">
                                        Kontak & Social Media
                                    </h2>
                                    <span class="flex-1 h-px bg-main"></span>
                                </div>

                                {{-- Ikon Sosial --}}
                                <div class="flex justify-center gap-3">
                                    @php
                                        $socials = [
                                            [
                                                'icon' => 'fa-brands fa-instagram',
                                                'link' => 'https://www.instagram.com/jasawebsite.biz/',
                                            ],
                                            [
                                                'icon' => 'fa-brands fa-whatsapp',
                                                'link' => 'https://wa.me/+6285173315798',
                                            ],
                                            [
                                                'icon' => 'fa-brands fa-tiktok',
                                                'link' => 'https://www.tiktok.com/@www.webz.biz',
                                            ],
                                        ];
                                    @endphp
                                    @foreach ($socials as $social)
                                        <a href="{{ $social['link'] }}"
                                            class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 hover:bg-pink-100 hover:text-main transition-colors duration-200">
                                            <i class="{{ $social['icon'] }} text-base"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Artikel Populer --}}
                            <h2 class="text-sm font-semibold uppercase tracking-wide border-b border-gray-200 pb-2">
                                Artikel Populer
                            </h2>

                            {{-- Daftar Artikel Populer --}}
                            <div class="flex flex-col divide-y divide-gray-100">
                                @foreach (collect($data)->shuffle()->take(6) as $item)
                                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                        class="flex items-center gap-4 py-3 group">
                                        <div class="w-20 h-16 flex-shrink-0 rounded-md overflow-hidden">
                                            <img src="{{ $item->banner
                                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                                alt="{{ $item->judul }}"
                                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h3
                                                class="text-sm font-semibold text-gray-800 group-hover:text-blue-500 transition-colors duration-200 leading-snug line-clamp-2">
                                                {{ $item->judul }}
                                            </h3>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </div>

    </div>
</x-layout.guest>
