{{-- AUTHOR: CHAN ZHENG JIE / POH YUAN HAO --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brand Detail (#'.$brand->id.')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('admin-brands-index')}}" class="underline">< Back to brand list</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="bg-neutral-50 border rounded-xl shadow p-3">
                        <div class="text-xl font-semibold flex justify-between">
                            <div>Brand details</div>
                            <div class="flex space-x-4">
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
                        </div>
                        <div class="flex-col flex my-1">
                            <label for="image" class="font-lg font-semibold">Brand Image</label>
                            <img src="{{ asset('storage'.$brand->image) }}" class="object-cover mx-auto">
                        </div>
                        <div class="flex-col flex my-1">
                            <label for="name" class="font-lg font-semibold">Brand Name</label>
                            <input type="text" id="name" name="name" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    value="{{$brand->name}}" disabled>
                        </div>
                        <div class="flex-col flex my-1">
                            <label for="description" class="font-lg font-semibold">Brand parts</label>
                            <input type="text" id="description" name="description" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                     value="{{$brand->parts->count()}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
