<?php

namespace App\Http\Livewire\Component\PartComparer;

use Livewire\Component;

class PartCard extends Component
{
    public $part;

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.component.part-comparer.part-card');
    }
}
