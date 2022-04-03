{{-- AUTHOR: CHAN ZHENG JIE / POH YUAN HAO --}}
<form wire:submit.prevent='save' method="POST" class="bg-neutral-50 border rounded-xl shadow p-3">
    @csrf
    <div class="flex-col flex my-1">
        <label for="name" class="font-lg font-semibold">Category Name</label>
        <input type="text" id="name" name="name" class="border-neutral-200 rounded-xl focus:ring-purple-500"
            placeholder="The category name..." wire:model='catName'>
        @error('catName')
            <div class="text-red-500">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="flex-col flex my-1">
        <label for="description" class="font-lg font-semibold">Category Description</label>
        <input type="text" id="description" name="description"
            class="border-neutral-200 rounded-xl focus:ring-purple-500" placeholder="The category description..."
            wire:model='catDesc'">
        @error('catDesc')
        <div class="     text-red-500">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="flex-col flex my-1">
        <label for="requried" class="font-lg font-semibold">Category Required in PC Builder?</label>
        <input type="checkbox" id="requried" name="requried" class="border-neutral-600 rounded-xl focus:ring-purple-500"
            wire:model='catReq'>
        @error('catReq')
        <div class="   text-red-500">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{-- Specs --}}
    @for ($i = 0; $i < $specNum; $i++)
        <div class="flex-col flex my-1">
            <label class="font-lg font-semibold">Spec {{ $i + 1 }}</label>
            <div class="flex">
                <input type="text" id="spec{{ $i + 1 }}" name="spec{{ $i + 1 }}"
                    class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/2"
                    placeholder="Spec {{ $i + 1 }} name..." wire:model='catSpec.{{ $i }}.name'>
                <select name="spec{{ $i + 1 }}Data" id="spec{{ $i + 1 }}Data"
                    class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/3"
                    wire:model='catSpec.{{ $i }}.datatype'>
                    <option value="string">String</option>
                    <option value="number">Number</option>
                    <option value="bool">Bool</option>
                </select>
            </div>
            @if ($catSpec[$i]['datatype'] == 'number')
                <div class="flex">
                    <input type="text" id="spec{{ $i + 1 }}" name="spec{{ $i + 1 }}Measurement"
                        class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/2"
                        placeholder="Measurment(i.e. cm/hz/hour)..."
                        wire:model='catSpec.{{ $i }}.measurement'>
                    <select name="spec{{ $i + 1 }}Comparison" id="spec{{ $i + 1 }}Comparison"
                        class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/3"
                        wire:model='catSpec.{{ $i }}.comparison'>
                        <option value=">">> More is better</option>
                        <option value="<">
                            < Less is better</option>
                    </select>
                </div>
            @else
                <div class="flex">
                    <input type="hidden" id="spec{{ $i + 1 }}" name="spec{{ $i + 1 }}Measurement"
                        class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/2"
                        placeholder="Measurment(i.e. cm/hz/hour)..."
                        wire:model='catSpec.{{ $i }}.measurement'>
                    <input type="hidden" id="spec{{ $i + 1 }}" name="spec{{ $i + 1 }}Comparison"
                        class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/2"
                        wire:model='catSpec.{{ $i }}.comparison'>
                </div>
            @endif
            @error('catSpec.' . str($i) . '.name')
                <div class="text-red-500">
                    {{ $message }}
                </div>
            @enderror
            @error('catSpec.' . str($i) . '.datatype')
                <div class="text-red-500">
                    {{ $message }}
                </div>
            @enderror
            @error('catSpec.' . str($i) . '.measurement')
                <div class="text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>
    @endfor
    <div>
        <button wire:click.prevent='addSpec' type="button"
            class="my-auto bg-indigo-500 text-xl font-semibold text-white rounded-xl py-2 px-4
                    hover:bg-indigo-400 transition duration-150 shadow-lg mt-4">
            Add More Spec
        </button>
    </div>

    <div class="w-full mt-4">
        <button
            class="w-full my-auto bg-indigo-500 text-xl font-semibold text-white rounded-xl py-2
                        hover:bg-indigo-400 transition duration-150 shadow-lg"
            type="submit" wire:loading.attr="disabled" wire:loading.class="cursor-wait bg-indigo-800"
            wire:loading.class.remove='bg-indigo-500 hover:bg-indigo-400'>
            Save Changes
        </button>
    </div>
</form>
