<div>
    <table class="w-full">
        <thead>
            <th class="w-4/12 border py-1">Categories</th>
            <th class="w-8/12 border py-1">Selected Part</th>
        </thead>
        <tbody>
            @foreach ($table as $td)
            @php
                $x = array_search($td, $table);
            @endphp
            <tr>
                <td class="w-4/12 border px-5 py-1 font-semibold text-lg my-auto">
                    {{$td['category']['name']}}
                    @if($td['category']['required'])
                    <span class="text-rose-400">*</span>
                    @endif
                </td>
                <td class="w-8/12 border px-5 py-1 my-auto">
                    @if($td['part'])
                    <div class="flex justify-between items-start">
                        <div class="flex items-start">
                            <div>
                                <a href="{{ route('show-component', $td['part']['id']) }}" target="_blank">
                                    <img src="{{ asset('storage'.$td['part']['image']) }}" class="h-24 w-24">
                                </a>
                            </div>
                            <div class="my-auto ml-4">
                                <div class="text-lg text-slate-500">
                                    <a href="{{ route('show-brand', $td['part']['brand']['id']) }}" target="_blank">
                                        {{ $td['part']['brand']['name'] }}
                                    </a>
                                </div>
                                <div class="text-xl">
                                    <a href="{{ route('show-component', $td['part']['id']) }}" target="_blank">
                                        {{ $td['part']['name'] }}
                                    </a>
                                </div>
                            </div>
                            <div class="my-auto ml-6">
                                <div class="text-lg">Price</div>
                                <div class="text-xl">RM{{ number_format($td['part']['price'], 2, '.') }}</div>
                            </div>
                        </div>

                        <div class="my-auto">
                            <button class="rounded-full bg-indigo-500 hover:bg-indigo-400 transition duration-150
                            text-white font-semibold text-xl px-2 py-1 ml-2" wire:click='removeComponent({{$x}})'>
                                Remove component
                            </button>
                        </div>
                    </div>
                    @else
                    <select wire:model="table.{{$x}}.currentlySelecting" class="rounded-xl focus:ring-1 focus:ring-fuchsia-400 outline-none">
                        @foreach ($td['availableParts'] as $availablePart)
                        <option value="{{ $availablePart['id'] }}">{{ $availablePart['name'] }}</option>
                        @endforeach
                    </select>
                    <button class="rounded-full bg-indigo-500 hover:bg-indigo-400 transition duration-150
                                text-white font-semibold text-xl px-2 py-1 ml-2" wire:click='selectComponent({{$x}})'>
                        Select component
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
