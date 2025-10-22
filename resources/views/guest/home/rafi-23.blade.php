<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
        <div class="w-full max-w-[1100px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-3 space-y-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach(array_slice($data, 1, 3) as $item)
                    <div
                        class="relative group rounded-2xl overflow-hidden cursor-pointer transition-transform duration-500 hover:-translate-y-1"
                        data-url="{{ route('detail', ['slug' => $item->slug]) }}">
                        {{-- Gambar utama --}}
                        <img src="{{ $item->banner 
                            ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                            : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-56 object-cover transition-transform duration-700 group-hover:scale-110" />

                        {{-- Overlay gradient --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                        {{-- Konten di bawah --}}
                        <div class="absolute bottom-0 w-full p-4 text-white">
                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach ($item->articles->articlecategory as $category)
                                <span class="bg-white/90 text-gray-900 text-[10px] font-semibold px-2 py-0.5 rounded-full">
                                    {{ strtoupper($category->category) }}
                                </span>
                                @endforeach
                            </div>
                            <h3 class="text-lg font-bold leading-snug line-clamp-2 group-hover:text-blue-400 transition">
                                {{ $item->judul }}
                            </h3>
                        </div>

                        {{-- Efek border glow saat hover --}}
                        <div
                            class="absolute inset-0 border-2 border-transparent rounded-2xl group-hover:border-blue-400/60 transition-all duration-500 pointer-events-none">
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Article --}}
                <div class=" w-full flex items-center gap-2 sm:gap-4">
                    <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                    <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
                </div>
                <div class="w-full">
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach(array_slice($trend, 0, 4) as $item)
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="group bg-white rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300">

                            {{-- Gambar --}}
                            <div class="relative w-full h-28 sm:h-32 md:h-36">
                                <img src="{{ $item->banner 
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    alt="{{ $item->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            </div>

                            {{-- Judul --}}
                            <div class="p-2">
                                <p class="text-sm sm:text-[15px] font-semibold leading-snug line-clamp-3 text-gray-800 hover:text-blue-600 transition-colors">
                                    {{ $item->judul }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

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
                        </div>
                    </a>
                    @endforeach
                </div>

                <div class="flex justify-center mt-6">
                    <a href="{{ route('article') }}">
                        <button class="px-6 py-2 flex items-center gap-2 rounded-full text-sm font-medium text-white bg-main hover:bg-main/30 shadow-md duration-300">
                            <span>Lihat Lainnya</span>
                            <div class="w-4 aspect-square">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" fill="currentColor"></path>
                                </svg>
                            </div>
                        </button>
                    </a>
                </div>
            </div>

            {{-- Popular Article --}}
            <div class="relative">
                <div class="md:sticky top-24 bg-white rounded-xl shadow-sm p-4 max-h-[70vh] overflow-hidden">
                    {{-- Judul --}}
                    <div class="flex items-center gap-2 mb-4">
                    <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                        <h2 class="font-bold text-lg text-black">Populer</h2>
                    </div>

                    <div class="overflow-y-auto pr-2 h-[calc(70vh-4rem)] scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 hover:scrollbar-thumb-gray-500 transition-all duration-300">
                        @foreach(array_slice($data, 0, 10) as $index => $item)
                        <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                            class="flex gap-3 py-3 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition rounded-lg px-1 group">
                            <div class="flex-shrink-0">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-600 font-bold text-sm group-hover:bg-red-50 group-hover:text-red-600 transition-colors">
                                    {{ $index + 1 }}
                                </span>
                            </div>

                            {{-- Konten --}}
                            <div class="flex-1 min-w-0">
                                <h4
                                    class="text-sm font-medium text-gray-800 leading-snug group-hover:text-blue-600 line-clamp-2 mb-1">
                                    {{ $item->judul }}
                                </h4>

                                {{-- Kategori --}}
                                @foreach ($item->articles->articlecategory as $category)
                                <p class="text-red-600 text-xs font-medium">{{ $category->category }}</p>
                                @endforeach
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('popularToggle');
            const closeBtn = document.getElementById('closePopular');
            const popularPanel = document.getElementById('popularPanel');

            if (!toggleBtn || !closeBtn || !popularPanel) return;

            function togglePanel() {
                popularPanel.classList.toggle('hidden');
                popularPanel.classList.toggle('translate-x-full');
                popularPanel.classList.toggle('fixed');
                popularPanel.classList.toggle('right-0');
                popularPanel.classList.toggle('top-0');
                popularPanel.classList.toggle('h-screen');
                popularPanel.classList.toggle('w-72');
                popularPanel.classList.toggle('z-20');
                popularPanel.classList.toggle('overflow-y-auto');
            }

            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                togglePanel();
            });

            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                togglePanel();
            });

            document.addEventListener('click', function(e) {
                if (!popularPanel.contains(e.target) && e.target !== toggleBtn) {
                    if (!popularPanel.classList.contains('hidden')) {
                        togglePanel();
                    }
                }
            });

            popularPanel.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            const cards = document.querySelectorAll(".article-card");

            cards.forEach(card => {
                card.addEventListener("click", () => {
                    const url = card.dataset.url;

                    // Clone card
                    const clone = card.cloneNode(true);
                    const rect = card.getBoundingClientRect();

                    // Style clone biar sama posisinya
                    clone.style.position = "fixed";
                    clone.style.top = rect.top + "px";
                    clone.style.left = rect.left + "px";
                    clone.style.width = rect.width + "px";
                    clone.style.height = rect.height + "px";
                    clone.style.zIndex = 9999;
                    clone.style.transition = "all 0.5s ease-in-out";

                    document.body.appendChild(clone);

                    // Trigger animasi ke full screen
                    requestAnimationFrame(() => {
                        clone.style.top = 0;
                        clone.style.left = 0;
                        clone.style.width = "100vw";
                        clone.style.height = "100vh";
                    });

                    // Setelah animasi selesai, redirect
                    setTimeout(() => {
                        window.location.href = url;
                    }, 300); // delay sedikit lebih lama dari transition
                });
            });
        });

        document.querySelectorAll('.group[data-url]').forEach(card => {
            card.addEventListener('click', () => {
                window.location.href = card.dataset.url;
            });
        });
    </script>

    <style>
        #popularPanel {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        }

        @media (min-width: 768px) {
            #popularToggle {
                display: none !important;
            }

            #popularPanel {
                transform: none !important;
                position: static !important;
                height: auto !important;
                width: auto !important;
            }
        }
    </style>

    </div>
</x-layout.guest>