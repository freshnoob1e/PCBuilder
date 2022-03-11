<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function components_index(){
        $parts = Part::latest()->with(['category', 'brand', 'reviews'])->get();
        return view('browse.components.index', [
            'parts' => $parts
        ]);
    }

    public function brands_index(){
        $brands = Brand::latest()->get();
        return view('browse.brands.index', [
            'brands' => $brands
        ]);
    }

    public function categories_index(){
        $categories = Category::latest()->with('parts')->get();
        return view('browse.categories.index', [
            'categories' => $categories
        ]);
    }
}
