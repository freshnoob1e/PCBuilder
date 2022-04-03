{{-- AUTHOR: CHAN ZHENG JIE / POH YUAN HAO --}}
<form wire:submit.prevent="save" method="POST"
        class="bg-neutral-50 border rounded-xl shadow p-3">
    @csrf
    <div class="flex-col flex my-1 relative">
        <label for="partImage" class="font-lg font-semibold">Part Image</label>
        <div class="flex">
            <input type="file" id="partImage" name="partImage" wire:model="partImage">
            <div wire:loading wire:target='partImage' class="flex">
                Uploading image, please wait...
            </div>
        </div>
        @error('partImage')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
        @if($partImage)
        <div>
            <div>Photo Preview: </div>
            <img src="{{ $partImage->temporaryUrl() }}" class="h-48 w-48 object-cover">
        </div>
        @endif
    </div>
    <div class="flex-col flex my-1">
        <label for="partName" class="font-lg font-semibold">Part Name</label>
        <input type="text" id="partName" name="partName" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                placeholder="The part name..." wire:model="partName">
        @error('partName')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="flex-col flex my-1">
        <label for="partDesc" class="font-lg font-semibold">Part Description</label>
        <input type="text" id="partDesc" name="partDesc" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                placeholder="The part description..." wire:model="partDesc">
        @error('partDesc')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="flex-col flex my-1">
        <label for="partPrice" class="font-lg font-semibold">Price (RM)</label>
        <input type="number" id="partPrice" name="partPrice" class="border-neutral-200 rounded-xl focus:ring-purple-500"
        placeholder="Price of the part..." wire:model="partPrice">
        @error('partPrice')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="flex-col flex mt-1 mb-4">
        <div class="flex w-full justify-between">
            <div class="flex flex-col w-[45%]">
                <label for="partBrand" class="font-lg font-semibold">Brand</label>
                <select name="partBrand" id="partBrand" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-2/3"
                        wire:model='partBrand' @if($brandDisabled) disabled @endif>
                    @if($brands->first())
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ ucfirst($brand->name) }}</option>
                    @endforeach
                    @else
                    <option value="null">No brands available</option>
                    @endif
                </select>
            </div>
            <div class="flex flex-col w-[45%]">
                <label for="partCat" class="font-lg font-semibold">Category</label>
                <select name="partCat" id="partCat" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-2/3"
                        wire:model='partCat' @if($catDisabled) disabled @endif>
                    @if($categories->first())
                    @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ ucfirst($cat->name) }}</option>
                    @endforeach
                    @else
                    <option value="null">No categories available</option>
                    @endif
                </select>
            </div>
        </div>
        @error('partBrand')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
    </div>

    {{-- Specs --}}
    <div class="flex-col flex mt-4 pt-4 border-t">
        <div class="font-semibold text-xl">
            Part Specs
        </div>
    </div>
    @if($specs)
    @php
        $i=1;
    @endphp
    @foreach ($specs as $spec)
    <div class="flex-col flex my-1">
        <label for="partSpec{{$i}}" class="font-lg font-semibold">
            @if ($spec->datatype == 'number')
            {{ucfirst($spec->name).' ('.ucfirst($spec->measurement).')'}}
            @else
            {{ucfirst($spec->name)}}
            @endif
        </label>
        @if($spec->datatype == 'string')
        <input type="text" id="partSpec{{$i}}" name="partSpec{{$i}}" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                placeholder="Enter {{$spec->name}}..." wire:model="partSpecs.{{$i-1}}.content">
        @elseif ($spec->datatype == 'number')
        <input type="number" id="partSpec{{$i}}" name="partSpec{{$i}}" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                placeholder="Enter {{$spec->name}}..." wire:model="partSpecs.{{$i-1}}.content">
        @else
        <input type="checkbox" id="partSpec{{$i}}" name="partSpec{{$i}}" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                placeholder="Enter {{$spec->name}}..." wire:model="partSpecs.{{$i-1}}.content">
        @endif
        @error('partSpecs.'.str($i-1).'.content')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
        @php
            $i++;
        @endphp
    </div>
    @endforeach
    @else
    <div>
        pls select category
    </div>
    @endif

    <div class="w-full mt-4">
        <button class="w-full my-auto bg-indigo-500 text-xl font-semibold text-white rounded-xl py-2
                        hover:bg-indigo-400 transition duration-150 shadow-lg" wire:loading.attr="disabled"
                        wire:loading.class="cursor-wait bg-indigo-800" wire:loading.class.remove='bg-indigo-500 hover:bg-indigo-400'>
            Save Changes
        </button>
    </div>
</form>
