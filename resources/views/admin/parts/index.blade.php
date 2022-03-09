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
                    <div class="text-xl font-semibold">Parts</div>
                    <div class="border rounded-lg mt-4">
                        <table class="w-full">
                            <thead class="border-b border-b-gray-400">
                                <th>
                                    Part name
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Brand
                                </th>
                                <th>
                                    Description
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
                                        {{$part->name}}
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        {{$part->category->name}}
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        {{$part->brand->name}}
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        {{$part->description}}
                                    </td>
                                </tr>
                                @php
                                    $i++
                                @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center font-semibold text-xl">
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
