<?php
// AUTHOR: CHAN ZHENG JIE / POH YUAN HAO

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Part;
use App\Models\PartSpec;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePartForm extends Component
{
    use WithFileUploads;

    // Controller data
    public $categories;
    public $brands;
    // Form data
    public $partImage;
    public $partName;
    public $partDesc;
    public $partCat;
    public $partBrand;
    public $partPrice;
    public $partSpecs;
    // Cat sec
    public $specs;
    // Local function var
    public $brandDisabled;
    public $catDisabled;

    public function mount()
    {
        if ($this->categories->first()) {
            $this->partCat = $this->categories->first()->id;
            $this->catDisabled = false;
            $this->getSpecs();
        } else {
            $this->partCat = null;
            $this->catDisabled = true;
        }

        if ($this->brands->first()) {
            $this->partBrand = $this->brands->first()->id;
            $this->brandDisabled = false;
        } else {
            $this->partBrand = null;
            $this->brandDisabled = true;
        }
    }

    protected function rules()
    {
        $partDetailRules = [
            'partImage' => ['required', 'image', 'max:2048'],
            'partName' => ['required', 'string', 'max:128', 'unique:brands,name'],
            'partDesc' => ['required', 'string', 'max:256'],
            'partCat' => ['required', 'exists:categories,id'],
            'partBrand' => ['required', 'exists:brands,id'],
            'partPrice' => ['required', 'numeric'],
        ];

        $i = 0;
        if ($this->specs) {
            foreach ($this->specs as $spec) {
                if ($spec->datatype == 'string') {
                    $partDetailRules['partSpecs.' . str($i) . '.content'] = ['required', 'string'];
                } else if ($spec->datatype == 'number') {
                    $partDetailRules['partSpecs.' . str($i) . '.content'] = ['required', 'numeric'];
                } else {
                    $partDetailRules['partSpecs.' . str($i) . '.content'] = ['required', 'boolean'];
                }
                $i++;
            }
        }

        return $partDetailRules;
    }

    protected function messages()
    {
        $partDetailErrorMessage = [
            'partImage.required' => 'Image field is required',
            'partImage.image' => 'Must be an image',
            'partImage.image' => 'File size cannot exceed 2MB',
            'partDesc.required' => 'The part description field is required.',
            'partDesc.string' => 'The part description must be string.',
            'partDesc.max' => 'The part description cannot exceed 256 characters.',
            'partPrice.required' => 'The part price field is required.',
            'partPrice.numeric' => 'The part price field must be numbers.',
            'partPrice.boolean' => 'This field must be True or False.',
        ];

        $i = 0;
        foreach ($this->specs as $spec) {
            $partDetailErrorMessage['partSpecs.' . str($i) . '.content.required'] = ucfirst($spec->name) . ' field is required.';
            $partDetailErrorMessage['partSpecs.' . str($i) . '.content.string'] = ucfirst($spec->name) . ' must be characters.';
            $partDetailErrorMessage['partSpecs.' . str($i) . '.content.numeric'] = ucfirst($spec->name) . ' must be numbers.';
            $partDetailErrorMessage['partSpecs.' . str($i) . '.content.boolean'] = ucfirst($spec->name) . ' must be True or False.';
            $i++;
        }

        return $partDetailErrorMessage;
    }

    public function updatedPartCat()
    {
        $this->validateOnly('partCat');
        $this->getSpecs();
    }

    private function getSpecs()
    {
        $cat = Category::find($this->partCat)->load('specs');
        $this->specs = $cat->specs;
        $this->initSpecData();
    }

    private function initSpecData()
    {
        $this->partSpecs = [];
        foreach ($this->specs as $spec) {
            if ($spec->datatype == 'string') {
                array_push($this->partSpecs, ['name' => $spec->name, 'content' => '', 'datatype' => $spec->datatype, 'measurement' => $spec->measurement, 'compare_logic' => $spec->compare_logic]);
            } else if ($spec->datatype == 'number') {
                array_push($this->partSpecs, ['name' => $spec->name, 'content' => 1, 'datatype' => $spec->datatype, 'measurement' => $spec->measurement, 'compare_logic' => $spec->compare_logic]);
            } else {
                array_push($this->partSpecs, ['name' => $spec->name, 'content' => false, 'datatype' => $spec->datatype, 'measurement' => $spec->measurement, 'compare_logic' => $spec->compare_logic]);
            }

        }
    }

    public function updatedPartImage()
    {
        $this->validateOnly('partImage');
    }

    public function save()
    {
        $this->validate();
        $image = Image::make($this->partImage)->resize(256, 256)->encode('webp');
        $fileName = time() . '_' . $this->partName . '.webp';
        $destPath = '/images/parts/' . $fileName;
        Storage::put($destPath, $image);

        $newPart = Part::create([
            'category_id' => $this->partCat,
            'brand_id' => $this->partBrand,
            'name' => $this->partName,
            'description' => $this->partDesc,
            'image' => $destPath,
            'price' => $this->partPrice,
            'not_compatible_parts' => json_encode([]),
        ]);

        PartSpec::create([
            'part_id' => $newPart->id,
            'properties' => json_encode($this->partSpecs),
        ]);

        return redirect()->route('admin-parts-index');
    }

    public function render()
    {
        return view('livewire.create-part-form');
    }
}
