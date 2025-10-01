<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class="w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.' . json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
        <div class="w-full max-w-[1100px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-3 space-y-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach (collect($data)->shuffle()->take(4) as $item)
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                        class="relative group rounded-xl overflow-hidden h-64 cursor-pointer">

                        <img src="{{ $item->banner 
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />

                        <div class="absolute inset-0 bg-black/60 transition-opacity duration-300 group-hover:bg-black/30"></div>

                        <div class="absolute bottom-4 right-4 text-white flex flex-col space-y-1 max-w-[70%] text-right">
                            <p class="line-clamp-2 font-bold hover:text-blue-600 duration-300">{{ $item->judul }}</p>

                        </div>
                    </a>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach(array_slice($data, 1, 3) as $item)
                    <div
                        class="article-card bg-white rounded-xl shadow-md overflow-hidden flex flex-col cursor-pointer hover:shadow-xl transition-shadow duration-300"
                        data-url="{{ route('detail', ['slug' => $item->slug]) }}">
                        {{-- Gambar --}}
                        <img src="{{ $item->banner 
                        ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                        : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-44 object-cover rounded-t-xl" />

                        {{-- Konten --}}
                        <div class="p-4 flex flex-col flex-grow">
                            <p class="line-clamp-2 font-bold hover:text-blue-600 duration-300">
                                {{ $item->judul }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Article --}}
                <div class=" w-full flex items-center gap-2 sm:gap-4">
                    <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                    <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(array_slice($trend, 0, 4) as $item)
                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                        class="bg-white rounded-xl border hover:border-blue-400 overflow-hidden flex flex-col cursor-pointer transition-all duration-300">

                        {{-- Image --}}
                        <div class="relative">
                            <img src="{{ $item->banner 
                                ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-56 object-cover" />
                            <span class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $item->articles->articlecategory[0]->category ?? 'Artikel' }}
                            </span>
                        </div>

                        {{-- Content --}}
                        <div class="p-5 flex flex-col flex-grow">
                            <p class="line-clamp-2 font-bold text-gray-800 hover:text-blue-600 duration-300">{{ $item->judul }}</p>
                            <p class="text-sm text-gray-500 mt-2 line-clamp-2">{!! Str::limit(strip_tags($item->article), 80) !!}</p>
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
            <div class="">
                <div class=" md:sticky top-24 space-y-4 sm:space-y-6">
                    {{-- Title --}}
                    <div class=" w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10">
                        <div class=" w-1 h-7 bg-second rounded-full"></div>
                        <p class=" text-xl font-bold text-center">Artikel Populer</p>
                    </div>

                    {{-- Article --}}
                    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4 sm:gap-8">
                        @include('components.section.popular')
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