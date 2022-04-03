<?php
// AUTHOR: CHAN ZHENG JIE / POH YUAN HAO

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategorySpec;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'category' => $category,
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $req)
    {
        $catData = $req->validate([
            'name' => ['required', 'string', 'unique:categories,name'],
            'description' => ['required', 'string', 'max:2048'],
        ]);

        $req->validate([
            'spec1Name' => ['required', 'string', 'max:128'],
            'spec1Data' => ['required', 'in:string,number,bool'],
            'spec2Name' => ['required', 'string', 'max:128'],
            'spec2Data' => ['required', 'in:string,number,bool'],
            'spec3Name' => ['required', 'string', 'max:128'],
            'spec3Data' => ['required', 'in:string,number,bool'],
        ]);

        $newCat = Category::create($catData);

        CategorySpec::create([
            'category_id' => $newCat->id,
            'name' => $req->spec1Name,
            'datatype' => $req->spec1Data,
        ]);
        CategorySpec::create([
            'category_id' => $newCat->id,
            'name' => $req->spec2Name,
            'datatype' => $req->spec2Data,
        ]);
        CategorySpec::create([
            'category_id' => $newCat->id,
            'name' => $req->spec3Name,
            'datatype' => $req->spec3Data,
        ]);

        return redirect()->route('admin-categories-show', $newCat->id);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category->load('specs'),
        ]);
    }

    public function update(Category $category, Request $req)
    {
        $catData = $req->validate([
            'name' => ['required', 'string', 'unique:categories,name,' . $category->id],
            'description' => ['required', 'string'],
        ]);

        $req->validate([
            'spec1Name' => ['required', 'string', 'max:128'],
            'spec1Data' => ['required', 'in:string,number,bool'],
            'spec2Name' => ['required', 'string', 'max:128'],
            'spec2Data' => ['required', 'in:string,number,bool'],
            'spec3Name' => ['required', 'string', 'max:128'],
            'spec3Data' => ['required', 'in:string,number,bool'],
        ]);

        $category->update($catData);

        CategorySpec::find($req->spec1ID)->update([
            'name' => $req->spec1Name,
            'datatype' => $req->spec1Data,
        ]);
        CategorySpec::find($req->spec2ID)->update([
            'name' => $req->spec2Name,
            'datatype' => $req->spec2Data,
        ]);
        CategorySpec::find($req->spec3ID)->update([
            'name' => $req->spec3Name,
            'datatype' => $req->spec3Data,
        ]);

        return redirect()->route('admin-categories-show', $category->id);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin-categories-index');
    }
}
