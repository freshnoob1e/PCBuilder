<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

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
    // Cat sec
    public $specs;
    // Local function var
    public $brandDisabled;
    public $catDisabled;

    public function mount(){
        if($this->categories->first()){
            $this->partCat = $this->categories->first()->id;
            $this->catDisabled = false;
            $this->getSpecs();
        } else {
            $this->partCat = null;
            $this->catDisabled = true;
        }

        if($this->brands->first()){
            $this->partBrand = $this->brands->first()->id;
            $this->brandDisabled = false;
        } else {
            $this->partBrand = null;
            $this->brandDisabled = true;
        }
    }

    protected function rules(){
        return [
            'partImage' => ['required', 'image', 'max:2048'],
            'partName' => ['required', 'string', 'max:128', 'unique:brands,name'],
            'partDesc' => ['required', 'string', 'max:256'],
            'partCat' => ['required', 'exists:categories,id'],
            'partBrand' => ['required', 'exists:brands,id']
        ];
    }

    public function updatedPartCat(){
        $this->validateOnly('partCat');
        $this->getSpecs();
    }

    private function getSpecs(){
        $cat = Category::find($this->partCat)->load('specs');
        $this->specs = $cat->specs;
    }

    public function updatedPartImage(){
        $this->validateOnly('partImage');
    }

    public function save(){
        // $this->validate();
        // $image = Image::make($this->partImage)->resize(256, 256)->encode('webp');
        // $fileName = time().'_'.$this->partName.'.webp';
        // $destPath = '/images/brands/'.$fileName;
        // Storage::put($destPath, $image);



        // $newPart = Brand::create([
        //     'name' => $this->brandName,
        //     'image' => $destPath
        // ]);

        // return redirect()->route('admin-brands-show', $newBrand->id);
    }

    public function render()
    {
        return view('livewire.create-part-form');
    }
}
