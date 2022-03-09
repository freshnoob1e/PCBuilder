<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <a class="bg-indigo-500 text-white font-semibold px-2 py-1 rounded-full" href="{{route('admin-users-index')}}">
                Manage Users
            </a>
            <a class="bg-indigo-500 text-white font-semibold px-2 py-1 rounded-full" href="{{route('admin-roles-index')}}">
                Roles list
            </a>
        </div>
    </div>
</x-app-layout>