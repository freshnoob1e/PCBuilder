<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategorySpec;
use Illuminate\Http\Request;

class CategorySpecController extends Controller
{
    public function index(){
        $categorySpecs = CategorySpec::latest()->with('category')->get();
        return view('category_specs.index', ['categorySpecs' => $categorySpecs]);
    }

    public function show(CategorySpec $categorySpec){
        return view('category_specs.show', [
            'categorySpec' => $categorySpec->load('category')
        ]);
    }

    public function create(){
        return view('category_specs.create', [
            'categories' => Category::latest()->get()
        ]);
    }

    public function store(Request $req){
        $data = $req->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'datatype' => ['required', 'string']
        ]);

        $newCatSpec = CategorySpec::create($data);
        return redirect()->route('category_specs-show', $newCatSpec->id);
    }

    public function edit(CategorySpec $categorySpec){
        return view('category_specs.edit', [
            'categorySpec' => $categorySpec->load('category'),
            'categories' => Category::latest()->get()
        ]);
    }

    public function update(CategorySpec $categorySpec, Request $req){
        $data = $req->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'datatype' => ['required', 'string']
        ]);

        $categorySpec->update($data);

        return redirect()->route('category_specs-show', $categorySpec->id);
    }

    public function destroy(CategorySpec $categorySpec){
        $categorySpec->delete();

        return redirect()->route('category_specs-index');
    }
}
