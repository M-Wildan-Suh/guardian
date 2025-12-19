<div
    class="w-full max-w-[1100px] mx-auto relative overflow-hidden rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.2)] group">

    <div id="heroSlider" class="flex transition-all duration-700 ease-in-out">
        @foreach (array_slice($data, 0, 3) as $item)
            <div class="min-w-full relative h-[380px] md:h-[480px] overflow-hidden">
                <img src="{{ $item->banner
                    ? 'https://bizlink.sites.id/storage/images/article/banner/' . $item->banner
                    : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                    class="w-full h-full object-cover transform duration-700 group-hover:scale-110" alt="">

                <div
                    class="absolute bottom-0 left-0 right-0 
                        bg-gradient-to-t from-black/80 via-black/40 to-transparent
                        p-6 md:p-10 flex flex-col gap-4">

                    <div class="flex flex-wrap gap-2">
                        @foreach ($item->articles->articlecategory as $category)
                            <a href="{{ route('category', ['category' => $category->slug]) }}">
                                <div
                                    class="py-1 px-4 bg-white/90 text-black text-xs font-semibold rounded-full uppercase shadow-md">
                                    {{ $category->category }}
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <a href="{{ route('detail', ['slug' => $item->slug]) }}">
                        <h2
                            class="text-2xl md:text-4xl lg:text-5xl font-extrabold leading-tight 
                               text-white drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)]">
                            {{ $item->judul }}
                        </h2>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Prev Button -->
    <button id="prevSlide"
        class="absolute left-4 top-1/2 -translate-y-1/2 
               bg-white/20 backdrop-blur-md border border-white/30
               text-white p-3 rounded-full hover:bg-white/40 shadow-lg transition">
        ‹
    </button>

    <!-- Next Button -->
    <button id="nextSlide"
        class="absolute right-4 top-1/2 -translate-y-1/2 
               bg-white/20 backdrop-blur-md border border-white/30
               text-white p-3 rounded-full hover:bg-white/40 shadow-lg transition">
        ›
    </button>

    <!-- Dot Slider -->
    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-3">
        <div class="w-3 h-3 bg-white/40 rounded-full slider-dot transition"></div>
        <div class="w-3 h-3 bg-white/40 rounded-full slider-dot transition"></div>
        <div class="w-3 h-3 bg-white/40 rounded-full slider-dot transition"></div>
    </div>

</div>

<script>
    const slider = document.getElementById('heroSlider');
    const dots = document.querySelectorAll('.slider-dot');

    let index = 0;
    const max = 2;

    function updateSlider() {
        slider.style.transform = `translateX(-${index * 100}%)`;

        dots.forEach((dot, i) => {
            dot.classList.toggle('bg-white', i === index);
            dot.classList.toggle('w-4', i === index);
            dot.classList.toggle('h-4', i === index);

            dot.classList.toggle('bg-white/40', i !== index);
            dot.classList.toggle('w-3', i !== index);
            dot.classList.toggle('h-3', i !== index);
        });
    }

    document.getElementById('nextSlide').onclick = () => {
        index = (index >= max) ? 0 : index + 1;
        updateSlider();
    };

    document.getElementById('prevSlide').onclick = () => {
        index = (index <= 0) ? max : index - 1;
        updateSlider();
    };

    setInterval(() => {
        index = (index >= max) ? 0 : index + 1;
        updateSlider();
    }, 5000);
</script>
