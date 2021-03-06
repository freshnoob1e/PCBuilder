{{-- AUTHOR: CHAN ZHENG JIE / POH YUAN HAO --}}
<form wire:submit.prevent="save" method="POST"
        class="bg-neutral-50 border rounded-xl shadow p-3">
    @csrf
    <div class="flex-col flex my-1 relative">
        <label for="brandImage" class="font-lg font-semibold">Brand Image</label>
        <div class="flex">
            <input type="file" id="brandImage" name="brandImage" wire:model="brandImage">
            <div wire:loading wire:target='brandImage' class="flex">
                Uploading image, please wait...
            </div>
        </div>
        @error('brandImage')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
        @if($brandImage)
        <div>
            <div>Photo Preview: </div>
            <img src="{{ $brandImage->temporaryUrl() }}" class="h-48 w-48 object-cover">
        </div>
        @endif
    </div>
    <div class="flex-col flex my-1">
        <label for="brandName" class="font-lg font-semibold">Brand Name</label>
        <input type="text" id="brandName" name="brandName" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                placeholder="The brand name..." wire:model="brandName">
        @error('brandName')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="w-full mt-4">
        <button class="w-full my-auto bg-indigo-500 text-xl font-semibold text-white rounded-xl py-2
                        hover:bg-indigo-400 transition duration-150 shadow-lg" wire:loading.attr="disabled"
                        wire:loading.class="cursor-wait bg-indigo-800" wire:loading.class.remove='bg-indigo-500 hover:bg-indigo-400'>
            Add
        </button>
    </div>
</form>
