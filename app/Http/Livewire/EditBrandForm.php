<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Image;
use Livewire\WithFileUploads;

class EditBrandForm extends Component
{
    use WithFileUploads;

    public $brandImage;
    public $brandName;
    public $brand;

    public function rules(){
        return [
            'brandImage' => ['nullable', 'image', 'max:2048'],
            'brandName' => ['required', 'string', 'max:128', 'unique:brands,name,'.$this->brand->id]
        ];
    }

    public function mount(){
        $this->brandName = $this->brand->name;
    }

    public function updatedBrandImage(){
        $this->validateOnly('brandImage');
    }

    public function save(){
        $this->validate();
        if($this->brandImage){
            if(Storage::exists($this->brand->image)){
                Storage::delete($this->brand->image);
            }
            $image = Image::make($this->brandImage)->resize(256, 256)->encode('webp');
            $fileName = time().'_'.$this->brandName.'.webp';
            $destPath = '/images/brands/'.$fileName;
            Storage::put($destPath, $image);

            $this->brand->update([
                'name' => $this->brandName,
                'image' => $destPath
            ]);
        }else{
            $this->brand->update([
                'name' => $this->brandName
            ]);
        }

        return redirect()->route('admin-brands-show', $this->brand->id);
    }

    public function render()
    {
        return view('livewire.edit-brand-form');
    }
}
