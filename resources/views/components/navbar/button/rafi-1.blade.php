@props(['title' => null, 'route' => null, 'active' => null, 'mobile' => null])
@if ($mobile)    
    <a href="{{$route}}">
        <button :class="open ? ' scale-100' : ' scale-0'" 
        class=" {{ request()->routeIs($active) ? 'text-white bg-second' : 'text-black hover:text-white hover:bg-second'}} w-full py-2 rounded-full font-semibold text-sm duration-300">
            {{$title}}
        </button>
    </a>
@else
    <a href="{{$route}}">
        <button class=" {{ request()->routeIs($active) ? 'text-white bg-second' : 'text-black hover:text-white hover:bg-second'}} px-5 py-1.5 rounded-full font-semibold text-base duration-300">{{$title}}</button>
    </a>
@endif