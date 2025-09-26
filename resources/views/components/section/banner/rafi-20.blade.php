<div class="w-full flex justify-center bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="w-full max-w-7xl px-4">
        <div class="swiper relative w-full h-[60vh] sm:h-[80vh] lg:h-[85vh] rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-br from-indigo-900 via-purple-900 to-slate-900 group">
            <div class="swiper-wrapper">
                @foreach (array_slice($trend, 0, 3) as $item)
                <div class="swiper-slide w-full h-full overflow-hidden relative">
                    <!-- Background Image with Parallax Effect -->
                    <div class="absolute inset-0 transform transition-transform duration-[3000ms] ease-out group-hover:scale-110">
                        <img src="{{$item->banner ? 'https://bizlink.sites.id/storage/images/article/banner/'. $item->banner : 'https://bizlink.sites.id/assets/images/placeholder.webp'}}"
                            class="w-full h-full object-cover opacity-85" alt="{{$item->judul}}">
                    </div>
                    
                    <!-- Advanced Gradient Overlays -->
                    <div class="absolute inset-0 bg-black/40"></div>
                    <div class="absolute inset-0 bg-black/40 to-transparent"></div>
                    <div class="absolute inset-0 bg-black/40"></div>
                    
                    <!-- Content Container -->
                    <div class="relative w-full h-full flex items-end z-20">
                        <div class="w-full max-w-6xl mx-auto px-6 sm:px-8 lg:px-12 py-8 sm:py-12 lg:py-16 text-white">
                            
                            <!-- Animated Content Wrapper -->
                            <div class="space-y-6 sm:space-y-8 transform transition-all duration-1000 translate-y-8 opacity-0 swiper-slide-active:translate-y-0 swiper-slide-active:opacity-100">
                                
                                <!-- Category Tags with Modern Design -->
                                <div class="flex flex-wrap gap-3 animate-fade-in-up">
                                    @foreach ($item->articles->articlecategory as $category)
                                    <a href="{{route('category', ['category' => $category->slug])}}" 
                                       class="group/tag relative overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full transform scale-0 group-hover/tag:scale-100 transition-transform duration-300"></div>
                                        <div class="relative px-4 py-2 bg-white/90 backdrop-blur-sm text-gray-800 text-sm font-bold rounded-full shadow-lg hover:text-white transition-colors duration-300 border border-white/20">
                                            {{$category->category}}
                                        </div>
                                    </a>
                                    @endforeach
                                </div>

                                <!-- Title with Stunning Typography -->
                                <a href="{{route('detail', ['slug' => $item->slug])}}" class="block group/title">
                                    <h1 class="text-3xl sm:text-5xl lg:text-7xl xl:text-8xl font-black leading-[0.9] max-w-5xl">
                                        <span class="bg-black/50 transition-all duration-700 drop-shadow-2xl line-clamp-3">
                                            {{$item->judul}}
                                        </span>
                                    </h1>
                                </a>

                                <!-- Description with Enhanced Styling -->
                                <div class="max-w-3xl">
                                    <p class="text-lg sm:text-xl lg:text-2xl font-light text-gray-200 leading-relaxed line-clamp-2 sm:line-clamp-3 drop-shadow-lg">
                                        {!! nl2br(Str::limit(strip_tags($item->article), 200)) !!}
                                    </p>
                                </div>

                                <!-- Author Section with Modern Card Design -->
                                <div class="flex items-center space-x-4 pt-6 border-t border-white/20">
                                    <div class="flex items-center space-x-4">

                                        <!-- Author Info -->
                                        <div class="space-y-1">
                                            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}" 
                                               class="block text-xl sm:text-2xl font-bold text-white hover:text-cyan-300 transition-colors duration-300 drop-shadow-md">
                                                {{$item->articles->user->name}}
                                            </a>
                                            <p class="text-sm sm:text-base text-gray-300 font-medium">
                                                {{$item->date}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Enhanced Navigation Arrows -->
            <div class="absolute top-1/2 left-4 sm:left-8 transform -translate-y-1/2 z-30">
                <button class="swiper-button-prev group/nav w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center hover:bg-white/20 hover:scale-110 transition-all duration-300 shadow-2xl">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white transform group-hover/nav:-translate-x-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
            </div>
            
            <div class="absolute top-1/2 right-4 sm:right-8 transform -translate-y-1/2 z-30">
                <button class="swiper-button-next group/nav w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center hover:bg-white/20 hover:scale-110 transition-all duration-300 shadow-2xl">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white transform group-hover/nav:translate-x-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Premium Pagination -->
            <div class="absolute bottom-6 sm:bottom-8 left-1/2 transform -translate-x-1/2 z-30">
                <div class="pagination flex items-center space-x-3 px-4 py-2 bg-black/20 backdrop-blur-md rounded-full border border-white/20"></div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-8 left-8 w-20 h-20 bg-gradient-to-br from-cyan-400/20 to-blue-500/20 rounded-full blur-xl"></div>
            <div class="absolute bottom-8 right-8 w-32 h-32 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-full blur-2xl"></div>
        </div>

        <!-- Progress Bar -->
        <div class="mt-6 relative">
            <div class="w-full h-1 bg-gray-200 rounded-full overflow-hidden">
                <div class="swiper-progress h-full bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full transition-all duration-300 ease-out" style="width: 33.33%"></div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enhanced Swiper Pagination */
    .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        opacity: 1;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(4px);
        position: relative;
        overflow: hidden;
    }

    .swiper-pagination-bullet::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(135deg, #06b6d4, #3b82f6, #8b5cf6);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .swiper-pagination-bullet-active {
        background: linear-gradient(135deg, #06b6d4, #3b82f6);
        border: 2px solid white;
        transform: scale(1.4);
        box-shadow: 0 0 20px rgba(6, 182, 212, 0.6), 0 0 40px rgba(59, 130, 246, 0.3);
        width: 32px;
        border-radius: 16px;
    }

    .swiper-pagination-bullet-active::before {
        opacity: 1;
        animation: pulse-glow 2s infinite;
    }

    @keyframes pulse-glow {
        0%, 100% { transform: scale(1); opacity: 0.3; }
        50% { transform: scale(1.2); opacity: 0.1; }
    }

    /* Custom button reset for Swiper */
    .swiper-button-prev,
    .swiper-button-next {
        width: auto !important;
        height: auto !important;
        margin-top: 0 !important;
    }

    .swiper-button-prev::after,
    .swiper-button-next::after {
        display: none;
    }

    /* Slide content animations */
    .swiper-slide-active .swiper-slide-active\:translate-y-0 {
        transform: translateY(0) !important;
        transition-delay: 0.3s;
    }

    .swiper-slide-active .swiper-slide-active\:opacity-100 {
        opacity: 1 !important;
        transition-delay: 0.3s;
    }

    /* Custom animations */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out;
    }

    /* Backdrop blur */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }

    .backdrop-blur-md {
        backdrop-filter: blur(12px);
    }

    /* Custom border width */
    .border-3 {
        border-width: 3px;
    }

    /* Responsive font scaling */
    @media (max-width: 640px) {
        .swiper-slide-active .swiper-slide-active\:translate-y-0,
        .swiper-slide-active .swiper-slide-active\:opacity-100 {
            transition-delay: 0.1s;
        }
    }
</style>

<script>
    window.addEventListener('load', function() {
        // Initialize Swiper with enhanced features
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: true,
            speed: 1200,
            effect: 'slide',
            grabCursor: true,
            watchOverflow: true,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: '.pagination',
                clickable: true,
                dynamicBullets: false,
                renderBullet: function(index, className) {
                    return `<span class="${className}"></span>`;
                },
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            mousewheel: {
                thresholdDelta: 70,
                sensitivity: 1,
            },
            breakpoints: {
                640: {
                    speed: 1000,
                },
                1024: {
                    speed: 1400,
                }
            },
            on: {
                init: function() {
                    updateProgressBar(this);
                    initSlideContent(this);
                },
                slideChange: function() {
                    updateProgressBar(this);
                    animateSlideContent(this);
                },
                progress: function() {
                    updateProgressBar(this);
                }
            }
        });

        // Progress bar update function
        function updateProgressBar(swiper) {
            const progress = document.querySelector('.swiper-progress');
            if (progress) {
                const progressPercentage = ((swiper.realIndex + 1) / swiper.slides.length) * 100;
                progress.style.width = progressPercentage + '%';
            }
        }

        // Initialize slide content animation
        function initSlideContent(swiper) {
            const activeSlide = swiper.slides[swiper.activeIndex];
            const content = activeSlide.querySelector('[class*="translate-y-8"]');
            if (content) {
                setTimeout(() => {
                    content.classList.add('swiper-slide-active:translate-y-0', 'swiper-slide-active:opacity-100');
                }, 200);
            }
        }

        // Animate slide content on change
        function animateSlideContent(swiper) {
            // Reset all slides
            swiper.slides.forEach(slide => {
                const content = slide.querySelector('[class*="translate-y-8"]');
                if (content) {
                    content.style.transform = 'translateY(32px)';
                    content.style.opacity = '0';
                }
            });

            // Animate active slide
            const activeSlide = swiper.slides[swiper.activeIndex];
            const content = activeSlide.querySelector('[class*="translate-y-8"]');
            if (content) {
                setTimeout(() => {
                    content.style.transform = 'translateY(0)';
                    content.style.opacity = '1';
                    content.style.transition = 'all 1s cubic-bezier(0.4, 0, 0.2, 1)';
                }, 100);
            }
        }

        // Intersection Observer for performance
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '50px'
        };

        const swiperObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    swiper.autoplay.start();
                } else {
                    swiper.autoplay.stop();
                }
            });
        }, observerOptions);

        swiperObserver.observe(document.querySelector('.swiper'));

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                swiper.slidePrev();
            } else if (e.key === 'ArrowRight') {
                swiper.slideNext();
            } else if (e.key === ' ') {
                e.preventDefault();
                if (swiper.autoplay.running) {
                    swiper.autoplay.stop();
                } else {
                    swiper.autoplay.start();
                }
            }
        });

        // Touch gestures for mobile
        let touchStartY = 0;
        document.querySelector('.swiper').addEventListener('touchstart', (e) => {
            touchStartY = e.touches[0].clientY;
        });

        document.querySelector('.swiper').addEventListener('touchend', (e) => {
            const touchEndY = e.changedTouches[0].clientY;
            const diff = touchStartY - touchEndY;
            
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    swiper.slideNext();
                } else {
                    swiper.slidePrev();
                }
            }
        });
    });
</script>