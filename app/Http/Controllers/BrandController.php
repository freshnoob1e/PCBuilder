<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::latest();
        return view('brands.index', [
            'brands' => $brands
        ]);
    }

    public function show(Brand $brand){
        return view('brands.show', [
            'brand' => $brand
        ]);
    }

    public function create(){
        return view('brands.create');
    }

    public function store(Request $req){
        $req->validate([
            'name' => ['required', 'string', 'unique:brands,name'],
            'image' => ['required', 'image']
        ]);

        // TODO add image

        $fileURL = '';

        $newBrand = Brand::create([
            'name' => $req->name,
            'image' => $fileURL
        ]);
        return redirect()->route('brands-show', $newBrand->id);
    }

    public function edit(Brand $brand){
        return view('brands.edit', [
            'brand' => $brand
        ]);
    }

    public function update(Brand $brand, Request $req){
        $req->validate([
            'name' => ['required', 'unique:brands,name,'.$brand->name],
            'image' => ['nullable', 'image']
        ]);

        if($req->hasFile('image')){
            // TODO delete old image
            // TODO add new image

            $fileURL='';
            $brand->update([
                'name' => $req->name,
                'image' => $fileURL
            ]);
        } else {
            $brand->update([
                'name' => $req->name
            ]);
        }

        return redirect()->route('brands-show', $brand->id);
    }

    public function destroy(Brand $brand){
        $brand->delete();
        return redirect()->route('brands-index');
    }
}
