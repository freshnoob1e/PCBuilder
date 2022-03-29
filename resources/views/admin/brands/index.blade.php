<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brands List') }}
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
                        <span class="text-xl font-semibold">Brands</span>
                        <a href="{{route('admin-brands-create')}}" class="rounded-lg bg-indigo-500 font-semibold text-white px-3 py-1">Add</a>
                    </div>
                    <div class="border rounded-lg mt-4">
                        <table class="w-full">
                            <thead class="border-b border-b-gray-400">
                                <th>
                                    Brand image
                                </th>
                                <th>
                                    Brand name
                                </th>
                                <th>
                                    Number of items
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @if($brands->first())
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($brands as $brand)
                                @if($i%2==0)
                                <tr class="border-b border-gray-300">
                                @else
                                <tr class="border-b border-gray-300 bg-gray-50">
                                @endif
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        <img src="{{ asset('storage'.$brand->image) }}" class="object-cover mx-auto">
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        <a href="{{ route('admin-brands-show', $brand->id) }}" class="underline">{{$brand->name}}</a>
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        {{$brand->parts->count()}}
                                    </td>
                                    <td class="border-l border-r border-gray-300 px-2 py-1 text-center">
                                        <div class="space-y-2 my-1">
                                            <a href="{{route('admin-brands-edit', $brand->id)}}" class="rounded-lg bg-indigo-500 font-semibold text-white px-3 py-1">Edit</a>
                                            <form action="{{ route('admin-brands-destroy', $brand->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button href="{{route('admin-brands-edit', $brand->id)}}" class="rounded-lg bg-rose-600 font-semibold text-white px-3 py-1"
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
                                    <td colspan="5" class="text-center font-semibold text-xl">
                                        No brands available...
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
