<div>
    <div class="text-4xl text-white font-bold text-center">Count: {{ $count }}</div>
    <div class="flex space-x-4">
        <button class="bg-red-500 text-white font-semibold text-xl px-2 py-1 rounded-full" wire:click="decrease">Decrease</button>
        <button class="bg-emerald-500 text-white font-semibold text-xl px-2 py-1 rounded-full" wire:click="increase">Increase</button>
    </div>
</div>
