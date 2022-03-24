<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CategorySpec;
use Livewire\Component;

class CreateCategoryForm extends Component
{
    // Category data
    public $catName;
    public $catDesc;
    // Category specs
    public $catSpec;

    public $specNum;

    protected function rules()
    {
        $partDetailRules = [
            'catName' => ['required', 'string', 'unique:categories,name'],
            'catDesc' => ['required', 'string', 'max:256'],
            'catSpec.*.name' => ['required', 'max:64'],
            'catSpec.*.datatype' => ['required', 'in:string,number,bool'],
            'catSpec.*.measurement' => ['nullable', 'string', 'max:32'],
        ];

        return $partDetailRules;
    }

    protected function messages()
    {
        $partDetailErrorMessage = [
            'catName.required' => 'Category name is required.',
            'catName.string' => 'Must be alphanumeric characters.',
            'catName.unique' => 'Category name has been taken.',
            'catDesc.required' => 'The category description field is required.',
            'catDesc.string' => 'The category description must be string.',
            'catDesc.max' => 'The category description cannot exceed 256 characters.',
        ];

        for ($i = 0; $i < $this->specNum; $i++) {
            $partDetailErrorMessage['catSpec.' . str($i) . '.name.required'] = 'Spec ' . str($i + 1) . ' name field is required.';
            $partDetailErrorMessage['catSpec.' . str($i) . '.name.max'] = 'Spec ' . str($i + 1) . ' name must not exceed 64 characters.';
            $partDetailErrorMessage['catSpec.' . str($i) . '.datatype.required'] = 'Spec ' . str($i + 1) . ' datatype field is required.';
            $partDetailErrorMessage['catSpec.' . str($i) . '.datatype.in'] = 'Spec ' . str($i + 1) . ' datatype is invalid.';
            $partDetailErrorMessage['catSpec.' . str($i) . '.measurement.max'] = 'Spec ' . str($i + 1) . ' measurement must not be greater than 32 characters.';
            $partDetailErrorMessage['catSpec.' . str($i) . '.measurement.required'] = 'Spec ' . str($i + 1) . ' measurement field is required.';
        }

        return $partDetailErrorMessage;
    }

    public function mount()
    {
        $this->specNum = 1;
        $this->catSpec = [];
        array_push($this->catSpec, ['name' => '', 'datatype' => 'string', 'measurement' => '']);
    }

    public function addSpec()
    {
        $this->specNum++;
        array_push($this->catSpec, ['name' => '', 'datatype' => 'string']);
    }

    public function removeAllSpecs()
    {
        $this->specNum = 1;
        $this->catSpec = [];
        array_push($this->catSpec, ['name' => '', 'datatype' => 'string']);
    }

    public function save()
    {
        $this->validate();

        for ($i = 0; $i < $this->specNum; $i++) {
            if ($this->catSpec[$i]['datatype'] == 'number') {
                $this->validate([
                    'catSpec.' . $i . '.measurement' => ['required', 'string', 'max:32'],
                ]);
            }
        }

        $newCat = Category::create([
            'name' => $this->catName,
            'description' => $this->catDesc,
        ]);
        $newCatId = $newCat->id;

        foreach ($this->catSpec as $spec) {
            if (array_key_exists('measurement', $spec)) {
                CategorySpec::create([
                    'category_id' => $newCatId,
                    'name' => $spec['name'],
                    'datatype' => $spec['datatype'],
                    'measurement' => $spec['measurement'],
                ]);
            } else {
                CategorySpec::create([
                    'category_id' => $newCatId,
                    'name' => $spec['name'],
                    'datatype' => $spec['datatype'],
                ]);
            }
        }

        return redirect()->route('admin-categories-show', $newCatId);
    }

    public function render()
    {
        return view('livewire.create-category-form');
    }
}
