<form class="bg-neutral-50 rounded-xl shadow p-3">
    <div class="flex justify-center space-x-10">
        <div class="w-full">
            <div class="text-lg">
                All Parts (Checked = compatible)
            </div>
            <div class="border rounded-xl overflow-x-hidden bg-gray-100 h-48">
                @foreach (range(0, 10) as $i)
                    <div class="my-auto border p-1 flex">
                        <div>
                            <input type="checkbox">
                        </div>
                        <div>heh{{ $i }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div>

        @foreach ($allParts as $part)
            {{ $part->name }}
        @endforeach
        <br />
        @foreach ($notCompatParts as $x)
            {{ $x }}
        @endforeach
    </div>
</form>
