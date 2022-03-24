<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPartForm extends Component
{
    use WithFileUploads;

    // Controller data
    public $categories;
    public $brands;
    public $part;
    public $currentSpecs;
    // Form data
    public $partImage;
    public $partName;
    public $partDesc;
    public $partCat;
    public $partBrand;
    public $partSpecs;
    // Cat sec
    public $specs;
    // Local function var
    public $brandDisabled;
    public $catDisabled;

    public function mount()
    {
        $this->partName = $this->part->name;
        $this->partDesc = $this->part->description;
        $this->partCat = $this->part->category->id;
        $this->partBrand = $this->part->brand->id;

        if ($this->categories->first()) {
            $this->catDisabled = false;
            $this->getSpecs();
        } else {
            $this->partCat = null;
            $this->catDisabled = true;
        }

        if ($this->brands->first()) {
            $this->brandDisabled = false;
        } else {
            $this->partBrand = null;
            $this->brandDisabled = true;
        }
    }

    protected function rules()
    {
        $partDetailRules = [
            'partImage' => ['nullable', 'image', 'max:2048'],
            'partName' => ['required', 'string', 'max:128', 'unique:brands,name'],
            'partDesc' => ['required', 'string', 'max:256'],
            'partCat' => ['required', 'exists:categories,id'],
            'partBrand' => ['required', 'exists:brands,id'],
        ];

        $i = 0;
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
        if ($this->partCat == $this->part->category->id) {
            $this->specs = $this->part->category->specs;
            $this->partSpecs = [];
            foreach ($this->specs as $spec) {
                foreach ($this->currentSpecs as $currentSpec) {
                    if (is_array($currentSpec)) {
                        if ($spec->name == $currentSpec['name']) {
                            array_push($this->partSpecs, ['name' => $currentSpec['name'], 'content' => $currentSpec['content'], 'datatype' => $currentSpec['datatype'], 'measurement' => $currentSpec['measurement']]);
                            break;
                        }
                    } else {
                        if ($spec->name == $currentSpec->name) {
                            array_push($this->partSpecs, ['name' => $currentSpec->name, 'content' => $currentSpec->content, 'datatype' => $currentSpec->datatype, 'measurement' => $currentSpec->measurement]);
                            break;
                        }
                    }
                }
            }
        } else {
            $cat = Category::find($this->partCat)->load('specs');
            $this->specs = $cat->specs;
            $this->initSpecData();
        }
    }

    private function initSpecData()
    {
        $this->partSpecs = [];
        foreach ($this->specs as $spec) {
            if ($spec->datatype == 'string') {
                array_push($this->partSpecs, ['name' => $spec->name, 'content' => '', 'datatype' => $spec->datatype, 'measurement' => $spec->measurement]);
            } else if ($spec->datatype == 'number') {
                array_push($this->partSpecs, ['name' => $spec->name, 'content' => 1, 'datatype' => $spec->datatype, 'measurement' => $spec->measurement]);
            } else {
                array_push($this->partSpecs, ['name' => $spec->name, 'content' => false, 'datatype' => $spec->datatype, 'measurement' => $spec->measurement]);
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
        if ($this->partImage) {
            if (Storage::exists($this->part->image)) {
                Storage::delete($this->part->image);
            }

            $image = Image::make($this->partImage)->resize(256, 256)->encode('webp');
            $fileName = time() . '_' . $this->partName . '.webp';
            $destPath = '/images/parts/' . $fileName;
            Storage::put($destPath, $image);

            $this->part->update([
                'category_id' => $this->partCat,
                'brand_id' => $this->partBrand,
                'name' => $this->partName,
                'description' => $this->partDesc,
                'image' => $destPath,
            ]);
        } else {
            $this->part->update([
                'category_id' => $this->partCat,
                'brand_id' => $this->partBrand,
                'name' => $this->partName,
                'description' => $this->partDesc,
            ]);
        }

        $this->part->spec->update([
            'properties' => json_encode($this->partSpecs),
        ]);

        return redirect()->route('admin-parts-show', $this->part->id);
    }

    public function render()
    {
        return view('livewire.edit-part-form');
    }
}
