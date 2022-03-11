<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Part Detail (#'.$part->id.')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('admin-parts-index')}}" class="underline">< Back to part list</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="bg-neutral-50 border rounded-xl shadow p-3">
                        <div class="text-xl font-semibold flex justify-between">
                            <div>Part details</div>
                            <div class="flex space-x-4">
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
                        </div>
                        <div class="flex-col flex my-1 relative">
                            <label for="partImage" class="font-lg font-semibold">Part Image</label>
                            <img src="{{ asset('storage/'.$part->image) }}" class="w-48 h-48">
                        </div>
                        <div class="flex-col flex my-1">
                            <label for="partName" class="font-lg font-semibold">Part Name</label>
                            <input type="text" id="partName" name="partName" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    placeholder="The part name..." value="{{ $part->name }}" disabled>
                        </div>
                        <div class="flex-col flex my-1">
                            <label for="partDesc" class="font-lg font-semibold">Part Description</label>
                            <input type="text" id="partDesc" name="partDesc" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    placeholder="The part description..." value="{{ $part->description }}" disabled>
                        </div>
                        <div class="flex-col flex mt-1 mb-4">
                            <div class="flex w-full justify-between">
                                <div class="flex flex-col w-[45%]">
                                    <label for="partBrand" class="font-lg font-semibold">Brand</label>
                                    <input type="text" id="partBrand" name="partBrand" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                            placeholder="The part description..." value="{{ $part->brand->name }}" disabled>
                                </div>
                                <div class="flex flex-col w-[45%]">
                                    <label for="partCat" class="font-lg font-semibold">Category</label>
                                    <input type="text" id="partCat" name="partCat" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                            placeholder="The part description..." value="{{ $part->category->name }}" disabled>
                                </div>
                            </div>
                        </div>

                        {{-- Specs --}}
                        <div class="flex-col flex mt-4 pt-4 border-t">
                            <div class="font-semibold text-xl">
                                Part Specs
                            </div>
                        </div>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($specs as $spec)
                        <div class="flex-col flex my-1">
                            <label for="partSpec{{$i}}" class="font-lg font-semibold">{{ucfirst($spec->name)}}</label>
                            @if($spec->datatype == 'string')
                            <input type="text" id="partSpec{{$i}}" name="partSpec{{$i}}" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    placeholder="Enter {{$spec->name}}..." value="{{ $spec->content }}" disabled>
                            @elseif ($spec->datatype == 'number')
                            <input type="number" id="partSpec{{$i}}" name="partSpec{{$i}}" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    placeholder="Enter {{$spec->name}}..." value="{{ $spec->content }}" disabled>
                            @else
                            @if ($spec->content)
                            <input type="checkbox" id="partSpec{{$i}}" name="partSpec{{$i}}" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    placeholder="Enter {{$spec->name}}..." checked disabled>
                            @else
                            <input type="checkbox" id="partSpec{{$i}}" name="partSpec{{$i}}" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    placeholder="Enter {{$spec->name}}..." checked disabled>
                            @endif
                            @endif

                            @php
                                $i++;
                            @endphp
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
