<?php
// AUTHOR: CHAN ZHENG JIE / POH YUAN HAO

namespace App\Http\Controllers;

use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->with('parts')->get();
        return view('admin.brands.index', [
            'brands' => $brands,
        ]);
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', [
            'brand' => $brand->load('parts'),
        ]);
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', [
            'brand' => $brand,
        ]);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin-brands-index');
    }
}
