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
                    {{ucfirst($td['category']['name'])}}
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
                            @if(is_array($td['part']))
                            @if(array_key_exists('notCompat', $td['part']) && $td['part']['notCompat'])
                            <div class="my-auto ml-6">
                                <div class="text-rose-700 text-xl">NOT COMPATIBLE</div>
                            </div>
                            @endif
                            @else
                            @if(property_exists($td['part'], 'notCompat') && $td['part']->notCompat)
                            <div class="my-auto ml-6">
                                <div class="text-rose-700 text-xl">NOT COMPATIBLE</div>
                            </div>
                            @endif
                            @endif
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
                        @if(!is_array($td['availableParts']))
                        @if (!$td['availableParts']->first())
                        <option value="{{-1}}">No part available</option>
                        @else
                        @foreach ($td['availableParts'] as $availablePart)
                        <option value="{{ $availablePart['id'] }}">{{ $availablePart['name'] }}</option>
                        @endforeach
                        @endif
                        @else
                        @if (!array_key_exists(0, $td['availableParts']))
                        <option value="{{-1}}">No part available</option>
                        @else
                        @foreach ($td['availableParts'] as $availablePart)
                        <option value="{{ $availablePart['id'] }}">{{ $availablePart['name'] }}</option>
                        @endforeach
                        @endif
                        @endif
                    </select>
                    @if(!is_array($td['availableParts']))
                    @if ($td['availableParts']->first())
                    <button class="rounded-full bg-indigo-500 hover:bg-indigo-400 transition duration-150
                                text-white font-semibold text-xl px-2 py-1 ml-2" wire:click='selectComponent({{$x}})'>
                        Select component
                    </button>
                    @endif
                    @else
                    @if (array_key_exists(0, $td['availableParts']))
                    <button class="rounded-full bg-indigo-500 hover:bg-indigo-400 transition duration-150
                                text-white font-semibold text-xl px-2 py-1 ml-2" wire:click='selectComponent({{$x}})'>
                        Select component
                    </button>
                    @endif
                    @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-8">
        <div class="text-2xl font-semibold">
            Summary
        </div>

        <div class="border rounded-xl p-6 space-y-12">
            @foreach ($table as $td)
            @if (is_array($td['category']))
            @if ($td['category']['required'])
            <div>
                <div class="font-semibold text-xl">{{$td['category']['name']}}</div>
                <hr class="my-2">
                @if ($td['part'])
                <div class="grid grid-cols-3">
                    <div class="row-span-1 col-span-1">
                        <img src="{{ asset('storage'.$td['part']['image']) }}" class="h-32 w-32 object-cover">
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part name:</div>
                        <div>{{ucfirst($td['part']['name'])}}</div>
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part price:</div>
                        <div>RM{{ number_format($td['part']['price'], 2, '.') }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part description:</div>
                        <div>{{$td['part']['description']}}</div>
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part brand:</div>
                        <div>{{ucfirst($td['part']['brand']['name'])}}</div>
                    </div>
                </div>
                @else
                <div class="text-center">
                    This category is required, please select a component
                </div>
                @endif
            </div>
            @else
            @if ($td['part'])
            <div>
                <div class="font-semibold text-xl">{{$td['category']['name']}}</div>
                <hr class="my-2">
                <div class="grid grid-cols-3">
                    <div class="row-span-1 col-span-1">
                        <img src="{{ asset('storage'.$td['part']['image']) }}" class="h-32 w-32 object-cover">
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part name:</div>
                        <div>{{ucfirst($td['part']['name'])}}</div>
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part price:</div>
                        <div>RM{{ number_format($td['part']['price'], 2, '.') }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part description:</div>
                        <div>{{$td['part']['description']}}</div>
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part brand:</div>
                        <div>{{ucfirst($td['part']['brand']['name'])}}</div>
                    </div>
                </div>
            </div>
            @endif
            @endif
            @else
            @if ($td['category']->required)
            <div>
                <div class="font-semibold text-xl">{{$td['category']->name}}</div>
                <hr class="my-2">
                @if ($td['part'])
                <div class="grid grid-cols-3">
                    <div class="row-span-1 col-span-1">
                        <img src="{{ asset('storage'.$td['part']['image']) }}" class="h-32 w-32 object-cover">
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part name:</div>
                        <div>{{ucfirst($td['part']['name'])}}</div>
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part price:</div>
                        <div>RM{{ number_format($td['part']['price'], 2, '.') }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part description:</div>
                        <div>{{$td['part']['description']}}</div>
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part brand:</div>
                        <div>{{ucfirst($td['part']['brand']['name'])}}</div>
                    </div>
                </div>
                @else
                <div class="text-center">
                    This category is required, please select a component
                </div>
                @endif
            </div>
            @else
            @if ($td['part'])
            <div>
                <div class="font-semibold text-xl">{{$td['category']->name}}</div>
                <hr class="my-2">
                <div class="grid grid-cols-3">
                    <div class="row-span-1 col-span-1">
                        <img src="{{ asset('storage'.$td['part']['image']) }}" class="h-32 w-32 object-cover">
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part name:</div>
                        <div>{{ucfirst($td['part']['name'])}}</div>
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part price:</div>
                        <div>RM{{ number_format($td['part']['price'], 2, '.') }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part description:</div>
                        <div>{{$td['part']['description']}}</div>
                    </div>
                    <div class="flex space-x-3 row-span-1 col-span-1">
                        <div class="font-semibold">Part brand:</div>
                        <div>{{ucfirst($td['part']['brand']['name'])}}</div>
                    </div>
                </div>
            </div>
            @endif
            @endif
            @endif
            @endforeach
            <div class="flex justify-end space-x-3">
                <div class="text-2xl font-semibold">
                    TOTAL:
                </div>
                <div class="text-2xl">
                    RM {{number_format($totalPrice, 2, '.')}}
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 flex">
        <div class="bg-indigo-500 hover:bg-indigo-400 transition duration-150 hover:ring-2 hover:ring-purple-500 px-2
                    py-1 font-semibold text-2xl text-white rounded-xl cursor-pointer" wire:click.prevent="saveXML">
            Save as XML
        </div>
    </div>
</div>
