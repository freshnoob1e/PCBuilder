<div class="border rounded-lg p-5">
    @if(!is_null($part))
    <div class="mx-auto text-center text-xl font-semibold">
        {{ $part->name }}
    </div>
    <div class="mx-auto mt-2">
        <img src="{{ asset('storage'.$part->image) }}" class="mx-auto w-52 h-52">
    </div>
    <div class="mx-auto text-center text-xl font-semibold">
        {{ $part->brand->name }}
    </div>
    @else
    <div class="text-xl text-center my-auto font-semibold">
        Please select a component to compare...
    </div>
    @endif
</div>
