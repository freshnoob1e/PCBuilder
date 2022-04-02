<div class="border rounded-xl mx-auto mt-24 p-5">
    <div class="text-2xl font-semibold">
        Comparing component
    </div>
    <div class="w-full grid grid-cols-2 gap-x-8 mt-4">
        <livewire:component.part-comparer.part-card :part='$part'>

        <livewire:component.part-comparer.part-card :part='$comparingPart'>
    </div>
    <div class="mx-auto flex items-start justify-center space-x-4 mt-8">
        <div class="my-auto">Compare against:</div>
        <select class="text-xs" wire:model="comparingPartId">
            @foreach ($comparableParts as $comparablePart)
            @if($comparablePart->id != $part->id)
            <option value="{{ $comparablePart->id }}">{{ $comparablePart->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="mx-auto mt-8">
        <div class="mx-8 text-center border-b text-2xl font-semibold">
            Comparison
        </div>
        <div class="mx-8">
            <table class="w-full border border-slate-500 rounded-xl">
                <thead>
                    <th class="border border-slate-300 w-3/12">Specs</th>
                    <th class="border border-slate-300 w-4/12">{{ $part->name }}</th>
                    <th class="border border-slate-300 w-4/12">{{ $comparingPart->name }}</th>
                </thead>
                <tbody>
                    @foreach ($partSpecsCombined as $spec)
                        <tr>
                            <td class="border border-slate-300 w-3/12 text-center">
                                {{ $spec['name'] }}
                            </td>
                            @if($spec['datatype'] != 'number')
                            <td class="border border-slate-300 w-4/12 text-center">
                                {{ $spec['mainContent'] }}
                            </td>
                            <td class="border border-slate-300 w-4/12 text-center">
                                {{ $spec['targetContent'] }}
                            </td>
                            @else
                            @if($spec['compareLogic'] == '>')
                            @if($spec['mainContent'] > $spec['targetContent'])
                            <td class="border border-slate-300 w-4/12 text-center text-green-700">
                                {{ $spec['mainContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            <td class="border border-slate-300 w-4/12 text-center text-red-600">
                                {{ $spec['targetContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            @elseif($spec['mainContent'] < $spec['targetContent'])
                            <td class="border border-slate-300 w-4/12 text-center text-red-600">
                                {{ $spec['mainContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            <td class="border border-slate-300 w-4/12 text-center text-green-700">
                                {{ $spec['targetContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            @else
                            <td class="border border-slate-300 w-4/12 text-center text-yellow-600">
                                {{ $spec['mainContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            <td class="border border-slate-300 w-4/12 text-center text-yellow-600">
                                {{ $spec['targetContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            @endif
                            @else
                            @if($spec['mainContent'] < $spec['targetContent'])
                            <td class="border border-slate-300 w-4/12 text-center text-green-700">
                                {{ $spec['mainContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            <td class="border border-slate-300 w-4/12 text-center text-red-600">
                                {{ $spec['targetContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            @elseif($spec['mainContent'] > $spec['targetContent'])
                            <td class="border border-slate-300 w-4/12 text-center text-red-600">
                                {{ $spec['mainContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            <td class="border border-slate-300 w-4/12 text-center text-green-700">
                                {{ $spec['targetContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            @else
                            <td class="border border-slate-300 w-4/12 text-center text-yellow-600">
                                {{ $spec['mainContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            <td class="border border-slate-300 w-4/12 text-center text-yellow-600">
                                {{ $spec['targetContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            @endif
                            <td class="border border-slate-300 w-4/12 text-center">
                                {{ $spec['mainContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            <td class="border border-slate-300 w-4/12 text-center">
                                {{ $spec['targetContent'].' '.ucfirst($spec['measurement']) }}
                            </td>
                            @endif
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
