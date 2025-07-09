<x-layout.app>
    <div class=" h-full flex flex-col justify-center items-center">
        <form action="{{route('register.store')}}" class=" w-full" method="post">
            @csrf
            @method('POST')
            <div class=" p-4 sm:p-8 w-full space-y-4 sm:space-y-6">
                <input type="text" name="code" placeholder="Enter Code..." value="{{old('code')}}" class=" w-full text-sm sm:text-base font-normal rounded-md border border-main focus:ring-third focus:border-third bg-background">
                <button class=" text-sm sm:text-base w-full py-2 border border-neutral-600 text-neutral-600 hover:border-main hover:bg-main hover:text-white duration-300 font-semibold rounded-md">Upload</button>
            </div>
        </form>
    </div>
</x-layout.app>