@props(['title' => null, 'route' => null, 'active' => null, 'mobile' => null])

@php
    $isActive = request()->routeIs($active);
    $baseClass = $isActive
        ? 'text-white bg-second'
        : 'text-black hover:text-white hover:bg-second';
@endphp

@if ($mobile)
    <a href="{{ $route }}">
        <button 
            :class="open ? 'scale-100' : 'scale-0'"
            class="{{ $baseClass }} w-full py-2 rounded-full font-semibold text-sm duration-300">
            {{ $title }}
        </button>
    </a>
@else
    <a href="{{ $route }}">
        <button 
            class="{{ $baseClass }} px-5 py-1.5 rounded-full font-semibold text-base duration-300">
            {{ $title }}
        </button>
    </a>
@endif
