<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function show(Category $category){
        return view('categories.show', [
            'category' => $category
        ]);
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $req){
        $data = $req->validate([
            'name' => ['required', 'string', 'unique:categories,name'],
            'description' => ['required', 'string']
        ]);

        $newCat = Category::create($data);
        return redirect()->route('categories-show', $newCat->id);
    }

    public function edit(Category $category){
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category, Request $req){
        $data = $req->validate([
            'name' => ['required', 'string', 'unique:categories,name,'.$category->name],
            'description' => ['required', 'string']
        ]);

        $category->update($data);
        return redirect()->route('categories-show', $category->id);
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('categories-index');
    }
}
