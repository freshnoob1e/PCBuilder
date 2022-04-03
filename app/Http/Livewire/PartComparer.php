<?php
// AUTHOR: LOH JIN YI

namespace App\Http\Livewire;

use App\Models\Part;
use Livewire\Component;

class PartComparer extends Component
{
    public $part;
    public $comparableParts;
    public $comparingPartId;
    public $comparingPart;
    public $partSpecsMain;
    public $partSpecsTarget;
    public $partSpecsCombined;

    public function mount()
    {
        $this->partSpecsMain = json_decode($this->part->spec->properties);
        $this->getCompareParts();
    }

    private function getCompareParts()
    {
        $categoryId = $this->part->category->id;
        $this->comparableParts = Part::where('category_id', $categoryId)->get();
        if ($this->comparableParts->first()) {
            foreach ($this->comparableParts as $comparablePart) {
                if ($comparablePart->id == $this->part->id) {
                    continue;
                }
                $this->comparingPartId = $comparablePart->id;
                $this->getComparePart();
            }
        } else {
            $this->comparingPartId = null;
        }
    }

    public function getComparePart()
    {
        $this->comparingPart = Part::find($this->comparingPartId)->load(['brand', 'spec', 'reviews', 'category']);
        $this->partSpecsTarget = json_decode($this->comparingPart->spec->properties);
        $this->combineSpec();
    }

    public function combineSpec()
    {
        $mainSpecs = $this->partSpecsMain;
        $targetSpecs = $this->partSpecsTarget;
        // dd($mainSpecs);
        $combineSpecs = [];
        foreach ($mainSpecs as $mainSpec) {
            foreach ($targetSpecs as $targetSpec) {
                if ($targetSpec->name == $mainSpec->name) {
                    array_push($combineSpecs, [
                        'name' => $mainSpec->name,
                        'compareLogic' => $mainSpec->compare_logic,
                        'datatype' => $mainSpec->datatype,
                        'measurement' => $mainSpec->measurement,
                        'mainContent' => $mainSpec->content,
                        'targetContent' => $targetSpec->content,
                    ]);
                    break;
                }
            }
        }
        $this->partSpecsCombined = $combineSpecs;
    }

    public function render()
    {
        return view('livewire.part-comparer');
    }
}
