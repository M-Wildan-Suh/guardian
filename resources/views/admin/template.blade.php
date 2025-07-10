<x-layout.app>
    <div class=" h-full flex flex-col justify-center items-center">
        <form action="{{route('template.store')}}" class=" w-full" method="post">
            @csrf
            @method('POST')
            <div class=" p-4 sm:p-8 w-full space-y-4 sm:space-y-6">
                <select name="template" class="w-full text-sm sm:text-base font-normal rounded-md border border-main focus:ring-third focus:border-third bg-background" id="">
                    @foreach ($templates as $item)
                        <option value="{{$item['name']}}" {{$item['name'] === $template ? 'selected' : ''}}>{{$item['name']}}</option>
                    @endforeach
                </select>
                <button class=" text-sm sm:text-base w-full py-2 border border-neutral-600 text-neutral-600 hover:border-main hover:bg-main hover:text-white duration-300 font-semibold rounded-md">Save</button>
            </div>
        </form>
    </div>
</x-layout.app>