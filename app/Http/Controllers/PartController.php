<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Part;
use App\Models\PartSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::latest()->with(['category', 'brand', 'spec'])->get();
        foreach ($parts as $part) {
            $part->spec = json_decode($part->spec->properties);
        }
        return view('admin.parts.index', [
            'parts' => $parts,
        ]);
    }

    public function show(Part $part)
    {
        $partSpec = $part->spec;
        $specs = json_decode($partSpec->properties);
        // dd($specs);
        return view('admin.parts.show', [
            'part' => $part->load(['category', 'brand', 'reviews']),
            'specs' => $specs,
        ]);
    }

    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.parts.create', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image'],
        ]);

        $cat = Category::find($req->category_id);
        $catSpecs = $cat->specs;

        $dataSpecs = $req->specs;
        // Validate part specs
        foreach ($dataSpecs as $dataSpec) {
            foreach ($catSpecs as $catSpec) {
                if ($catSpec->name == $dataSpec['name']) {
                    if ($catSpec->datatype == 'string') {
                        if (!is_string($dataSpec['value'])) {
                            abort(403, $catSpec->name . ' field must be string');
                        }
                        $dataSpec['datatype'] = 'string';
                    } else if ($catSpec->datatype == 'number') {
                        if (!is_numeric($dataSpec['value'])) {
                            abort(403, $catSpec->name . ' field must be number');
                        }
                        $dataSpec['datatype'] = 'number';
                    } else if ($catSpec->datatype == 'bool') {
                        if (!is_bool($dataSpec['value'])) {
                            abort(403, $catSpec->name . ' field must be boolean');
                        }
                        $dataSpec['datatype'] = 'bool';
                    }
                    break;
                }
            }
        }

        $newPart = Part::create($data);

        foreach ($dataSpecs as $dataSpec) {
            $specDataJson = json_encode([
                'name' => $dataSpec['name'],
                'datatype' => $dataSpec['datatype'],
                'measurement' => $dataSpec['measurement'],
                'value' => $dataSpec['value'],
            ]);

            PartSpec::create([
                'part_id' => $newPart->id,
                'properties' => $specDataJson,
            ]);
        }

        return redirect()->route('parts-show', $newPart->id);
    }

    public function edit(Part $part)
    {
        $part = $part->load(['category.specs', 'brand', 'spec']);
        $partSpec = $part->spec;
        $specs = json_decode($partSpec->properties);

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('admin.parts.edit', [
            'categories' => $categories,
            'brands' => $brands,
            'currentSpecs' => $specs,
            'part' => $part,
        ]);
    }

    public function update(Part $part, Request $req)
    {
        $data = $req->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image'],
        ]);

        $cat = Category::find($req->category_id);
        $catSpecs = $cat->specs;

        $dataSpecs = $req->specs;
        // Validate part specs
        foreach ($dataSpecs as $dataSpec) {
            foreach ($catSpecs as $catSpec) {
                if ($catSpec->name == $dataSpec['name']) {
                    if ($catSpec->datatype == 'string') {
                        if (!is_string($dataSpec['value'])) {
                            abort(403, $catSpec->name . ' field must be string');
                        }
                        $dataSpec['datatype'] = 'string';
                    } else if ($catSpec->datatype == 'number') {
                        if (!is_numeric($dataSpec['value'])) {
                            abort(403, $catSpec->name . ' field must be number');
                        }
                        $dataSpec['datatype'] = 'number';
                    } else if ($catSpec->datatype == 'bool') {
                        if (!is_bool($dataSpec['value'])) {
                            abort(403, $catSpec->name . ' field must be boolean');
                        }
                        $dataSpec['datatype'] = 'bool';
                    }
                    break;
                }
            }
        }

        $specs = $part->specs;
        $specs->delete();

        $newPart = $part->update($data);

        foreach ($dataSpecs as $dataSpec) {
            $specDataJson = json_encode([
                'name' => $dataSpec['name'],
                'datatype' => $dataSpec['datatype'],
                'value' => $dataSpec['value'],
            ]);

            PartSpec::create([
                'part_id' => $part->id,
                'properties' => $specDataJson,
            ]);
        }

        return redirect()->route('parts-show', $part->id);
    }

    public function destroy(Part $part)
    {
        if (Storage::exists($part->image)) {
            Storage::delete($part->image);
        }
        $part->delete();
        return redirect()->route('admin.parts-index');
    }
}
