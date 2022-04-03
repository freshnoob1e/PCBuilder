<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use SimpleXMLElement;

class PCBuilder extends Component
{
    public $allCats;
    public $table;
    public $totalPrice = 0;

    public function mount()
    {
        $this->table = [];
        $this->allCats = Category::all()->load('parts');
        foreach ($this->allCats as $cat) {
            if ($cat->parts->first()) {
                $tableData = [
                    'category' => $cat,
                    'part' => null,
                    'availableParts' => $cat->parts,
                    'currentlySelecting' => $cat->parts->first()->id,
                ];
                array_push($this->table, $tableData);
            } else {
                $tableData = [
                    'category' => $cat,
                    'part' => null,
                    'availableParts' => $cat->parts,
                    'currentlySelecting' => -1,
                ];
                array_push($this->table, $tableData);
            }
        }
    }

    public function selectComponent($tableIndex)
    {
        if ($this->table[$tableIndex]['currentlySelecting'] == -1) {
            return;
        }
        $selectPart = Part::find($this->table[$tableIndex]['currentlySelecting'])->load(['brand', 'spec'])->toArray();
        $selectPart['not_compatible_parts'] = json_decode($selectPart['not_compatible_parts']);
        foreach ($selectPart['not_compatible_parts'] as $notCompatPartId) {
            for ($x = 0; $x < count($this->table); $x++) {
                if ($x == $tableIndex) {
                    continue;
                }
                if (!is_null($this->table[$x]['part'])) {
                    if ($this->table[$x]['part']['id'] == $notCompatPartId) {
                        $this->table[$x]['part']['notCompat'] = true;
                        $selectPart['notCompat'] = true;
                    }
                }
            }
        }
        $this->table[$tableIndex]['part'] = $selectPart;
        $this->getPrice();
    }

    public function removeComponent($tableIndex)
    {
        $this->table[$tableIndex]['part'] = null;
        $this->getPrice();
    }

    public function getPrice()
    {
        $newTtlPrice = 0;
        foreach ($this->table as $td) {
            if (is_null($td['part'])) {
                continue;
            }
            if (is_array($td['part'])) {
                $newTtlPrice += $td['part']['price'];
            } else {
                $newTtlPrice += $td['part']->price;
            }
        }
        $this->totalPrice = $newTtlPrice;
    }

    public function saveXML()
    {
        $table = $this->table;
        $newTable = [];
        foreach ($table as $td) {
            if ($td['category']['required']) {
                if (is_null($td['part'])) {
                    return;
                } else {
                    $newTD = [
                        'category' => $td['category']['name'],
                        'partName' => $td['part']['name'],
                        'partImg' => asset('storage' . $td['part']['image']),
                        'partPrice' => $td['part']['price'],
                        'partDesc' => $td['part']['description'],
                        'partBrand' => $td['part']['brand']['name'],
                        'brandImg' => asset('storage' . $td['part']['brand']['image']),
                        'brandSpec' => json_decode($td['part']['spec']['properties'], true),
                        'createdAt' => $td['part']['created_at'],
                        'updatedAt' => $td['part']['updated_at'],
                    ];
                    array_push($newTable, $newTD);
                    continue;
                }
            }
            if (!is_null($td['part'])) {
                $newTD = [
                    'category' => $td['category']['name'],
                    'partName' => $td['part']['name'],
                    'partImg' => asset('storage' . $td['part']['image']),
                    'partPrice' => $td['part']['price'],
                    'partDesc' => $td['part']['description'],
                    'partBrand' => $td['part']['brand']['name'],
                    'brandImg' => asset('storage' . $td['part']['brand']['image']),
                    'brandSpec' => json_decode($td['part']['spec']['properties'], true),
                    'createdAt' => $td['part']['created_at'],
                    'updatedAt' => $td['part']['updated_at'],
                ];
                array_push($newTable, $newTD);
                continue;
            }
        }

        $pcXml = new SimpleXMLElement('<pc/>');
        arrayToXml($newTable, $pcXml);
        saveXMLAsFile($pcXml, 'PCXML');

        return Storage::download('xml/PCXML.xml');
    }

    public function render()
    {
        return view('livewire.p-c-builder');
    }
}
