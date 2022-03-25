<?php

namespace App\Http\Livewire;

use App\Models\CategorySpec;
use Livewire\Component;

class EditCategoryForm extends Component
{
    // Category data
    public $catName;
    public $catDesc;
    // Category specs
    public $catSpec;
    public $delSpec;

    public $specNum;

    public $category;

    public $test = 'heh';

    protected function rules()
    {
        $partDetailRules = [
            'catName' => ['required', 'string', 'unique:categories,name,' . $this->category->id],
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
            $partDetailErrorMessage['catSpec.' . str($i) . '.comparison.in'] = 'Spec ' . str($i + 1) . ' compare logic must be > or <.';
            $partDetailErrorMessage['catSpec.' . str($i) . '.comparison.required'] = 'Spec ' . str($i + 1) . ' compare logic is required.';
        }

        return $partDetailErrorMessage;
    }

    public function mount()
    {
        $this->specNum = $this->category->specs->count();
        $this->catName = $this->category->name;
        $this->catDesc = $this->category->description;
        $this->delSpec = [];
        $this->catSpec = [];
        foreach ($this->category->specs as $spec) {
            array_push($this->catSpec, [
                'specId' => $spec->id,
                'name' => $spec->name,
                'datatype' => $spec->datatype,
                'measurement' => $spec->measurement,
                'comparison' => $spec->compare_logic,
            ]);
        }
    }

    public function addSpec()
    {
        $this->specNum++;
        array_push($this->catSpec, ['name' => '', 'datatype' => 'string', 'measurement' => '', 'comparison' => '>']);
    }

    public function save()
    {
        $this->validate();

        for ($i = 0; $i < $this->specNum; $i++) {
            if ($this->catSpec[$i]['datatype'] == 'number') {
                $this->validate([
                    'catSpec.' . $i . '.measurement' => ['required', 'string', 'max:32'],
                    'catSpec.' . $i . '.comparison' => ['required', 'string', 'in:<,>'],
                ]);
            }
        }

        $this->category->update([
            'name' => $this->catName,
            'description' => $this->catDesc,
        ]);

        foreach ($this->catSpec as $spec) {
            if (array_key_exists('specId', $spec)) {
                CategorySpec::find($spec['specId'])->update([
                    'name' => $spec['name'],
                    'datatype' => $spec['datatype'],
                    'measurement' => $spec['measurement'],
                    'compare_logic' => $spec['comparison'],
                ]);
            } else {
                if (array_key_exists('measurement', $spec)) {
                    CategorySpec::create([
                        'category_id' => $this->category->id,
                        'name' => $spec['name'],
                        'datatype' => $spec['datatype'],
                        'measurement' => $spec['measurement'],
                        'compare_logic' => $spec['comparison'],
                    ]);
                } else {
                    CategorySpec::create([
                        'category_id' => $this->category->id,
                        'name' => $spec['name'],
                        'datatype' => $spec['datatype'],
                    ]);
                }
            }
        }

        return redirect()->route('admin-categories-show', $this->category->id);
    }

    public function render()
    {
        return view('livewire.edit-category-form');
    }
}
