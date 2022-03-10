<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Parts List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('admin-dashboard')}}" class="underline">< Back to dashboard</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="w-full flex justify-between">
                        <span class="text-xl font-semibold">Parts</span>
                        <a href="{{route('admin-parts-create')}}"
                            class="rounded-lg bg-indigo-500 font-semibold text-white px-3 py-1">Add</a>
                    </div>
                    <div class="border rounded-lg mt-4 overflow-hidden">
                        <table class="w-full">
                            <thead class="border-b border-b-gray-400">
                                <th>
                                    Part Image
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Brand
                                </th>
                                <th>
                                    Specs
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @if($parts->first())
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($parts as $part)
                                @if($i%2==0)
                                <tr class="border-b border-gray-300">
                                @else
                                <tr class="border-b border-gray-300 bg-gray-50">
                                @endif
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        ye
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        <a href="{{ route('admin-parts-show', $part->id) }}" class="underline">{{$part->name}}</a>
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        {{$part->description}}
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        {{$part->category->name}}
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        {{$part->brand->name}}
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        <ul>
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach ($part->spec as $spec)
                                            @php
                                            $i++
                                            @endphp
                                            <li>
                                                {{-- {{$i.'. '}} --}}
                                                @if ($spec->datatype == 'string' || $spec->datatype == 'number')
                                                    {{$spec->name}}: {{$spec->content}}
                                                @elseif ($spec->content)
                                                    {{$spec->name}}: True
                                                @else
                                                    {{$spec->name}}: False
                                                @endif
                                            </li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        <div class="space-y-2 my-1">
                                            <a href="{{route('admin-parts-edit', $part->id)}}" class="rounded-lg bg-indigo-500 font-semibold text-white px-3 py-1">Edit</a>
                                            <form action="{{ route('admin-parts-destroy', $part->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button href="{{route('admin-parts-edit', $part->id)}}" class="rounded-lg bg-rose-600 font-semibold text-white px-3 py-1"
                                                        type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $i++
                                @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="text-center font-semibold text-xl">
                                        No parts available...
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
