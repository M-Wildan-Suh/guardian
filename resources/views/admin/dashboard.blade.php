<x-layout.app>
    <div class=" h-full flex flex-col justify-center items-center">
        <div class=" p-4 sm:p-8 w-full flex flex-col gap-4 sm:gap-6">
            <a href="{{route('website')}}">
                <button class=" text-sm sm:text-base w-full py-2 border border-neutral-600 text-neutral-600 hover:border-main hover:bg-main hover:text-white duration-300 font-semibold rounded-md">Website</button>
            </a>
            <a href="{{route('code')}}">
                <button class=" text-sm sm:text-base w-full py-2 border border-neutral-600 text-neutral-600 hover:border-main hover:bg-main hover:text-white duration-300 font-semibold rounded-md">Code</button>
            </a>
            <a href="{{route('template')}}">
                <button class=" text-sm sm:text-base w-full py-2 border border-neutral-600 text-neutral-600 hover:border-main hover:bg-main hover:text-white duration-300 font-semibold rounded-md">Template</button>
            </a>
            <a href="{{route('logout')}}">
                <button class=" text-sm sm:text-base w-full py-2 border border-neutral-600 text-neutral-600 hover:border-main hover:bg-main hover:text-white duration-300 font-semibold rounded-md">Logout</button>
            </a>
        </div>
    </div>
</x-layout.app>