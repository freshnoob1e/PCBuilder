<form class="border rounded-lg px-3 py-1" wire:submit.prevent='post'>
    <div class="flex items-start">
        @if(!is_null(Auth::user()->profile_photo_path))
        <img src="/storage/{{Auth::user()->profile_photo_path}}" class="h-24 w-24 rounded-full">
        @else
        <img src="{{Auth::user()->profile_photo_url}}" class="h-24 w-24 rounded-full">
        @endif
        <div class="w-full">
            <div class="mx-5">
                <div class="flex items-start">
                    <div class="font-semibold text-xl my-auto ml-1">
                        {{ Auth::user()->name }}
                    </div>
                </div>
                <div class="my-auto flex items-start justify-between">
                    <div class="flex">
                        @for ($x=1;$x<6;$x++)
                        @if($rating < $x)
                        <img src="{{ asset('storage/images/svg/star_outline.svg') }}" class="h-8 w-8 cursor-pointer"
                            wire:click.prevent='changeRating({{$x}})' wire:loading.class='cursor-wait' wire:loading.class.remove='cursor-pointer'>
                        @else
                        <img src="{{ asset('storage/images/svg/star_solid.svg') }}" class="h-8 w-8 cursor-pointer"
                             wire:click.prevent='changeRating({{$x}})' wire:loading.class='cursor-wait' wire:loading.class.remove='cursor-pointer'>
                        @endif
                        @endfor
                    </div>
                    <div>
                        <button class="bg-indigo-500 hover:bg-indigo-400 cursor-pointer transition duration-150 text-white font-semibold px-2 py-1 rounded-xl text-xl"
                                wire:loading.class='cursor-wait' wire:loading.class.remove='cursor-pointer'>
                            POST
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-3 w-full">
                <textarea namerows="4" class="w-full border border-gray-400 rounded-lg resize-none" wire:model='text'></textarea>
            </div>
        </div>
    </div>
</form>
