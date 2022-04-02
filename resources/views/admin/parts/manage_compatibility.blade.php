<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mange Part (#' . $part->id . ')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{ route('admin-parts-index') }}" class="underline">
                    < Back to part list</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="w-full flex justify-between">
                        <span class="text-xl font-semibold">Manage Parts Compatibility</span>
                    </div>
                    <livewire:manage-compatibility :managePart='$part'>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
