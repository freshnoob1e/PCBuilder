<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBrandForm extends Component
{
    use WithFileUploads;

    public $brandImage;
    public $brandName;

    protected $rules = [
        'brandImage' => ['required', 'image', 'max:2048'],
        'brandName' => ['required', 'string', 'max:128', 'unique:brands,name'],
    ];

    public function updatedBrandImage()
    {
        $this->validateOnly('brandImage');
    }

    public function save()
    {
        $this->validate();
        $image = Image::make($this->brandImage)->resize(256, 256)->encode('webp');
        $fileName = time() . '_' . $this->brandName . '.webp';
        $destPath = '/images/brands/' . $fileName;
        Storage::put($destPath, $image);

        $newBrand = Brand::create([
            'name' => $this->brandName,
            'image' => $destPath,
        ]);

        return redirect()->route('admin-brands-show', $newBrand->id);
    }

    public function render()
    {
        return view('livewire.create-brand-form');
    }
}
