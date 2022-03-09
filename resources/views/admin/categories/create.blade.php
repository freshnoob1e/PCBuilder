<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Category') }}
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
                    <div class="w-full flex justify-between">
                        <span class="text-xl font-semibold">Add Category</span>
                    </div>
                    <form action="{{route('admin-categories-store')}}" method="POST"
                            class="bg-neutral-50 border rounded-xl shadow p-3">
                        @csrf
                        <div class="flex-col flex my-1">
                            <label for="name" class="font-lg font-semibold">Category Name</label>
                            <input type="text" id="name" name="name" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                    placeholder="The category name..." value="{{old('name')}}">
                            @error('name')
                            <div class="text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="flex-col flex my-1">
                            <label for="description" class="font-lg font-semibold">Category Description</label>
                            <input type="text" id="description" name="description" class="border-neutral-200 rounded-xl focus:ring-purple-500"
                                     placeholder="The category description..." value="{{old('description')}}">
                            @error('description')
                            <div class="text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        {{-- Specs --}}
                        {{-- Spec 1 --}}
                        <div class="flex-col flex my-1">
                            <label class="font-lg font-semibold">1st Spec</label>
                            <div>
                                <input type="text" id="spec1Name" name="spec1Name" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/2"
                                         placeholder="First spec name..." value="{{old('spec1Name')}}">
                                <select name="spec1Data" id="spec1Data" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/3"
                                        value="{{old('spec1Data')}}">
                                    <option value="string">String</option>
                                    <option value="number">Number</option>
                                    <option value="bool">Bool</option>
                                </select>
                            </div>
                            @error('spec1Name')
                            <div class="text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                            @error('spec1Data')
                            <div class="text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        {{-- Spec 2 --}}
                        <div class="flex-col flex my-1">
                            <label class="font-lg font-semibold">2nd Spec</label>
                            <div>
                                <input type="text" id="spec2Name" name="spec2Name" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/2"
                                         placeholder="First spec name..." value="{{old('spec2Name')}}">
                                <select name="spec2Data" id="spec2Data" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/3"
                                        value="{{old('spec2Data')}}">
                                    <option value="string">String</option>
                                    <option value="number">Number</option>
                                    <option value="bool">Bool</option>
                                </select>
                            </div>
                            @error('spec2Name')
                            <div class="text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                            @error('spec2Data')
                            <div class="text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        {{-- Spec 3 --}}
                        <div class="flex-col flex my-1">
                            <label class="font-lg font-semibold">3rd Spec</label>
                            <div>
                                <input type="text" id="spec3Name" name="spec3Name" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/2"
                                         placeholder="First spec name..." value="{{old('spec3Name')}}">
                                <select name="spec3Data" id="spec3Data" class="border-neutral-200 rounded-xl focus:ring-purple-500 w-1/3"
                                        value="{{old('spec3Data')}}">
                                    <option value="string">String</option>
                                    <option value="number">Number</option>
                                    <option value="bool">Bool</option>
                                </select>
                            </div>
                            @error('spec3Name')
                            <div class="text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                            @error('spec3Data')
                            <div class="text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="w-full mt-4">
                            <button class="w-full my-auto bg-indigo-500 text-xl font-semibold text-white rounded-xl py-2
                                            hover:bg-indigo-400 transition duration-150 shadow-lg">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
