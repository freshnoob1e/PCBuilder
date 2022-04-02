<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Part;
use Livewire\Component;

class PCBuilder extends Component
{
    public $allCats;
    public $table;

    public function mount()
    {
        $this->table = [];
        $this->allCats = Category::all()->load('parts');
        foreach ($this->allCats as $cat) {
            if ($cat->required) {
                $tableData = [
                    'category' => $cat,
                    'part' => null,
                    'availableParts' => $cat->parts,
                    'currentlySelecting' => $cat->parts->first()->id,
                ];
                array_push($this->table, $tableData);
            }
        }
    }

    public function selectComponent($tableIndex)
    {
        $selectPart = Part::find($this->table[$tableIndex]['currentlySelecting'])->load('brand');
        $this->table[$tableIndex]['part'] = $selectPart;
    }

    public function removeComponent($tableIndex)
    {
        $this->table[$tableIndex]['part'] = null;
    }

    public function render()
    {
        return view('livewire.p-c-builder');
    }
}
