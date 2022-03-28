<form class="bg-neutral-50 rounded-xl p-3">
    <div class="flex justify-center space-x-10">
        <div class="w-full">
            <div class="text-lg">
                All Parts (Checked = compatible)
            </div>
            <div class="border rounded-xl overflow-x-hidden bg-gray-50 h-80">
            @php
                $x = 1
            @endphp
            @foreach ($allParts as $part)
                @if ($x % 2 == 0)
                <div class="my-auto border p-1 flex cursor-pointer" wire:click="onCheck({{$part->id}})">
                @else
                <div class="my-auto border p-1 flex cursor-pointer bg-gray-100" wire:click="onCheck({{$part->id}})">
                @endif
                    <div class="mr-6">
                        @if (!empty($notCompatParts) && in_array($part->id, $notCompatParts))
                        <input type="checkbox" disabled>
                        @else
                        <input type="checkbox" checked disabled>
                        @endif
                    </div>
                    <div>{{ $part->name }}</div>
                </div>
                @php
                    $x+=1
                @endphp
            @endforeach
            </div>
        </div>
    </div>
</form>
