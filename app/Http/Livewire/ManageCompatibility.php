<?php
// AUTHOR: CHAN ZHENG JIE / POH YUAN HAO

namespace App\Http\Livewire;

use App\Models\Part;
use Exception;
use Livewire\Component;

class ManageCompatibility extends Component
{
    public $allParts;
    public $notCompatParts;
    public $managePart;

    public function mount()
    {
        $this->allParts = Part::where('id', '!=', $this->managePart->id)->get();
        $this->refreshList();
    }

    private function refreshList()
    {
        $this->notCompatParts = json_decode($this->managePart->not_compatible_parts);
    }

    public function onCheck($partId)
    {
        if (in_array($partId, $this->notCompatParts)) {
            $index = array_search($partId, $this->notCompatParts);
            try {
                $newList = $this->notCompatParts;
                array_splice($newList, $index, 1);
                $newList = json_encode($newList);
                $this->managePart->update([
                    'not_compatible_parts' => $newList,
                ]);
            } catch (Exception $e) {
                throw $e;
            }
            array_splice($this->notCompatParts, $index, 1);
        } else {
            try {
                $newList = $this->notCompatParts;
                array_push($newList, $partId);
                $newList = json_encode($newList);
                $this->managePart->update([
                    'not_compatible_parts' => $newList,
                ]);
            } catch (Exception $e) {
                throw $e;
            }
            array_push($this->notCompatParts, $partId);
        }
    }

    public function render()
    {
        return view('livewire.manage-compatibility');
    }
}
