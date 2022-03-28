<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ManageCompatibility extends Component
{
    public $allParts;
    public $notCompatParts;

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.manage-compatibility');
    }
}
