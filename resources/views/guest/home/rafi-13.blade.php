<x-layout.guest :template="json_decode(\Storage::get('website.json'))->template" :title="optional(json_decode(\Storage::get('website.json'), true))['title'] ?? 'title'" :category="$category">
    <div class=" w-full px-4 sm:px-8 py-8 sm:py-12 space-y-4 sm:space-y-8">
        {{-- Banner --}}
        @include('components.section.banner.'.json_decode(\Storage::get('website.json'))->template)

        {{-- Article --}}
        <div class=" w-full max-w-[1080px] mx-auto">
            <div class=" w-full grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-8">
                {{-- Main --}}
                <div class=" w-full col-span-1 md:col-span-3 space-y-4 sm:space-y-8">
                    {{-- Title --}}
                    <div class=" w-full flex justify-between items-center">
                        <div class=" w-full flex items-center gap-2 sm:gap-4">
                            <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-second rounded-full"></div>
                            <p class=" text-xl sm:text-3xl font-bold text-center">Artikel Terbaru</p>
                        </div>
                    </div>

                    {{-- Article --}}
                    <div class="space-y-6">
                        @foreach (array_slice($trend, 0, 4) as $item)
                        <div class="flex gap-4 items-start">
                            {{-- Thumbnail --}}
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="flex-shrink-0">
                                <img src="{{ $item->banner 
                                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner 
                                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                    alt="{{ $item->judul }}"
                                    class="w-32 h-24 md:w-48 md:h-32 object-cover rounded-lg" />
                            </a>

                            {{-- Konten --}}
                            <div class="flex flex-col justify-between flex-1">
                                <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <h3 class="font-semibold text-base md:text-lg text-black hover:text-main line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>
                                </a>

                                <p class="text-sm text-gray-600 mt-1 line-clamp-2 hidden md:block">
                                    {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-14">
                        <a href="{{ route('article') }}" class="inline-block px-7 py-3 bg-main text-white rounded-full font-semibold hover:opacity-90 transition">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                {{-- Popular --}}
                <div class="relative">

                    <div class="hidden md:block md:sticky top-24 space-y-4 sm:space-y-6 bg-white p-4 rounded-lg shadow-lg border border-gray-100 transition-all duration-300 transform translate-x-full md:translate-x-0">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                            <div class="flex items-center gap-3 h-10">
                                <div class="w-1.5 h-7 bg-second rounded-full"></div>
                                <p class="text-xl font-bold text-gray-800">Artikel Populer</p>
                            </div>
                            <button id="closePopular" class="md:hidden text-gray-500 hover:text-gray-700 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Articles Content -->
                        <div class="grid grid-cols-1 gap-4">
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

                // Check if elements exist
                if (!toggleBtn || !closeBtn || !popularPanel) {
                    console.error("One or more elements not found!");
                    return;
                }

                // Toggle panel visibility
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

                // Toggle panel on button click
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    togglePanel();
                });

                // Close panel on close button click
                closeBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    togglePanel();
                });

                // Close panel when clicking outside
                document.addEventListener('click', function(e) {
                    if (!popularPanel.contains(e.target) && e.target !== toggleBtn) {
                        if (!popularPanel.classList.contains('hidden')) {
                            togglePanel();
                        }
                    }
                });

                // Prevent panel click from closing
                popularPanel.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        </script>

        <style>
            /* Smooth transitions */
            #popularPanel {
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
            }

            /* Desktop styles */
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