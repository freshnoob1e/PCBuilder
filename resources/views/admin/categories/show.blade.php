<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Detail (#'.$category->id.')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('admin-categories-index')}}" class="underline">< Back to category list</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="bg-neutral-50 border rounded-xl shadow p-3">
                        <div class="text-xl font-semibold flex justify-between">
                            <div>Category details</div>
                            <div class="flex space-x-4">
                                <a href="{{route('admin-categories-edit', $category->id)}}" class="rounded-lg bg-indigo-500 font-semibold text-white px-3 py-1">Edit</a>
                                <form action="{{ route('admin-categories-destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button href="{{route('admin-categories-edit', $category->id)}}" class="rounded-lg bg-rose-600 font-semibold text-white px-3 py-1"
                                            type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="flex-col flex my-1">
                            <label for="name" class="font-lg font-semibold">Category Name</label>
                            <input type="text" id="name" name="name" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    placeholder="The category name..." value="{{$category->name}}" disabled>
                        </div>
                        <div class="flex-col flex my-1">
                            <label for="description" class="font-lg font-semibold">Category Description</label>
                            <input type="text" id="description" name="description" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                     placeholder="The category description..." value="{{$category->description}}" disabled>
                        </div>
                        <div class="my-3 py-3 border-t">
                            <div class="font-semibold text-xl">Specs</div>
                            @foreach ($category->specs as $spec)
                            <div class="mt-4">
                                <div class="text-lg">First spec</div>
                                <div class="flex w-full">
                                    <input type="text" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/2"
                                             value="{{ucfirst($spec->name)}}" disabled>
                                    <select class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/3"
                                            value="{{$spec->datatype}}" disabled>
                                        <option value="{{$spec->datatype}}">{{ucfirst($spec->datatype)}}</option>
                                    </select>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
