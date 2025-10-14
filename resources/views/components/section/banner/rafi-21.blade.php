<div class="w-full max-w-[1080px] mx-auto mt-8 px-4 sm:px-6 lg:px-0">
    <div class="w-full grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

        <div class="lg:col-span-2 relative group">
            <div class="swiper featuredSwiper w-full h-64 sm:h-96 rounded-2xl overflow-hidden bg-gray-100 shadow-lg hover:shadow-xl transition-all duration-500">
                <div class="swiper-wrapper">
                    @foreach (array_slice($trend, 0, 3) as $item)
                    <div class="swiper-slide relative">
                        <div class="absolute inset-0">
                            <img
                                src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/'. $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                                class="w-full h-full object-cover transition-transform duration-700 swiper-zoom-target"
                                alt="{{ $item->judul }}"
                                loading="lazy">
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                        <div class="absolute bottom-0 left-10 right-0 p-6 text-white transform transition-transform duration-500 group-hover:translateY-[-10px]">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($item->articles->articlecategory as $category)
                                <a href="{{ route('category', ['category' => $category->slug]) }}"
                                    class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full hover:bg-white/30 transition-all duration-300 transform hover:scale-105">
                                    {{ $category->category }}
                                </a>
                                @endforeach
                            </div>

                            <!-- Title -->
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                class="block mb-3 group/title">
                                <h3 class="text-xl sm:text-3xl font-bold line-clamp-2 leading-tight group-hover/title:text-blue-300 transition-colors duration-300">
                                    {{ $item->judul }}
                                </h3>
                            </a>

                            <!-- Description -->
                            <p class="text-sm sm:text-base text-gray-200 line-clamp-2 mb-4 opacity-90 leading-relaxed">
                                {!! nl2br(Str::limit(strip_tags($item->article), 120)) !!}
                            </p>

                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="featured-pagination absolute bottom-4 left-1/2 transform -translate-x-1/2 z-10 flex gap-2"></div>

                <div class="absolute inset-y-0 left-0 flex items-center px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="swiper-button-prev-featured w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white cursor-pointer hover:bg-white/30 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="swiper-button-next-featured w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white cursor-pointer hover:bg-white/30 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4 sm:space-y-6">
            @foreach (array_slice($trend, 3, 6) as $item)
            <article class="group relative bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 h-32 sm:h-28 {{ $loop->index === 2 ? 'lg:col-span-2' : '' }}">
                <div class="flex h-full">
                    <!-- Image -->
                    <div class="w-2/5 relative overflow-hidden">
                        <img
                            src="{{ $item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/'. $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp' }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            alt="{{ $item->judul }}"
                            loading="lazy">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300"></div>

                        <!-- Category Badge -->
                        <div class="absolute top-2 left-2">
                            @if(isset($item->articles->articlecategory[0]))
                            <span class="bg-white/90 text-gray-800 text-xs px-2 py-1 rounded-full font-medium">
                                {{ $item->articles->articlecategory[0]->category }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="w-3/5 p-3 flex flex-col justify-between">
                        <div>
                            <a href="{{ route('detail', ['slug' => $item->slug]) }}" class="group/title">
                                <h4 class="font-bold text-md line-clamp-2 mb-2 group-hover/title:text-blue-600 transition-colors duration-300">
                                    {{ $item->judul }}
                                </h4>
                            </a>
                        </div>

                        <p class="text-sm sm:text-base font-medium text-black line-clamp-2 mt-1 opacity-90 leading-relaxed">
                            {!! nl2br(Str::limit(strip_tags($item->article), 100)) !!}
                        </p>

                    </div>
                </div>

                <div class="absolute bottom-0 left-0 w-0 h-1 bg-blue-500 group-hover:w-full transition-all duration-500"></div>
            </article>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Featured Swiper
        const featuredSwiper = new Swiper('.featuredSwiper', {
            loop: true,
            speed: 800,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            effect: 'creative',
            creativeEffect: {
                prev: {
                    translate: [0, 0, -400],
                },
                next: {
                    translate: ['100%', 0, 0],
                },
            },
            zoom: {
                maxRatio: 1.1,
                minRatio: 1,
            },
            pagination: {
                el: '.featured-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return `<span class="${className} w-2 h-2 bg-white/50 rounded-full transition-all duration-300 cursor-pointer hover:bg-white/80"></span>`;
                },
            },
            navigation: {
                nextEl: '.swiper-button-next-featured',
                prevEl: '.swiper-button-prev-featured',
            },
            on: {
                init: function() {
                    this.zoom.in();
                },
                slideChangeTransitionStart: function() {
                    this.zoom.out();
                },
                slideChangeTransitionEnd: function() {
                    this.zoom.in();
                }
            }
        });

        // Add active class to pagination bullets
        featuredSwiper.on('paginationUpdate', function() {
            const bullets = document.querySelectorAll('.featured-pagination .swiper-pagination-bullet');
            bullets.forEach((bullet, index) => {
                if (bullet.classList.contains('swiper-pagination-bullet-active')) {
                    bullet.classList.add('!w-6', '!bg-white');
                } else {
                    bullet.classList.remove('!w-6', '!bg-white');
                }
            });
        });

        // Hover effects for side articles
        const sideArticles = document.querySelectorAll('article.group');
        sideArticles.forEach(article => {
            article.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            article.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-1px)';
            });
        });
    });
</script>

<style>
    .featuredSwiper .swiper-pagination-bullet-active {
        width: 24px !important;
        background: white !important;
    }

    .swiper-slide {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .swiper-slide-active {
        opacity: 1;
    }

    .swiper-slide .swiper-zoom-target {
        transition: transform 0.8s ease;
    }

    .group:hover .swiper-slide-active .swiper-zoom-target {
        transform: scale(1.05);
    }

    * {
        transition-property: color, background-color, border-color, transform, box-shadow;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
</style>