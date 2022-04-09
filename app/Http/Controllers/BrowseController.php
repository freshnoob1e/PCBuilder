<?php
// AUTHOR: CHAN ZHENG JIE / POH YUAN HAO

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Part;
use Illuminate\Support\Facades\Storage;

class BrowseController extends Controller
{
    public function components_index()
    {
        $parts = Part::latest()->with(['category', 'brand', 'reviews'])->get();
        foreach ($parts as $part) {
            if (!$part->reviews->first()) {
                continue;
            }
            $ratings = [];
            foreach ($part->reviews as $review) {
                array_push($ratings, $review->rating);
            }
            $part->avgRating = round(collect($ratings)->avg());
        }
        return view('browse.components.index', [
            'parts' => $parts,
        ]);
    }

    public function brands_index()
    {
        $brands = Brand::latest()->get();
        return view('browse.brands.index', [
            'brands' => $brands,
        ]);
    }

    public function categories_index()
    {
        $categories = Category::latest()->with('parts')->get();
        return view('browse.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function component_show(Part $part)
    {
        $part = $part->load(['category', 'reviews.user', 'brand', 'spec']);
        $partSpec = json_decode($part->spec->properties);

        return view('browse.components.show', [
            'part' => $part,
            'partSpec' => $partSpec,
        ]);
    }

    public function brand_show(Brand $brand)
    {
        $brandParts = $brand->parts()->with(['category', 'reviews'])->get();
        foreach ($brandParts as $part) {
            if (!$part->reviews->first()) {
                continue;
            }
            $ratings = [];
            foreach ($part->reviews as $review) {
                array_push($ratings, $review->rating);
            }
            $part->avgRating = round(collect($ratings)->avg());
        }

        return view('browse.brands.show', [
            'brand' => $brand,
            'brandParts' => $brandParts,
        ]);
    }

    public function category_show(Category $category)
    {
        $category = $category->load(['parts.brand', 'parts.reviews']);
        foreach ($category->parts as $part) {
            if (!$part->reviews->first()) {
                continue;
            }
            $ratings = [];
            foreach ($part->reviews as $review) {
                array_push($ratings, $review->rating);
            }
            $part->avgRating = round(collect($ratings)->avg());
        }
        return view('browse.categories.show', [
            'category' => $category,
        ]);
    }

    public function get_all_components_json()
    {
        $parts = Part::latest()->with(['category', 'brand', 'reviews'])->get();
        foreach ($parts as $part) {
            if (!$part->reviews->first()) {
                continue;
            }
            $ratings = [];
            foreach ($part->reviews as $review) {
                array_push($ratings, $review->rating);
            }
            $part->avgRating = round(collect($ratings)->avg());
        }
        return response()->json($parts);
    }

    public function get_all_brands_json()
    {
        $brands = Brand::latest()->get();
        return response()->json($brands);
    }

    public function get_all_categories_json()
    {
        $categories = Category::latest()->with('parts')->get();
        return response()->json($categories);
    }

    public function get_component_json(Part $part)
    {
        $part = $part->load(['category', 'reviews.user', 'brand', 'spec']);
        $partSpec = json_decode($part->spec->properties);

        return response()->json([
            'part' => $part,
            'partSpec' => $partSpec,
        ]);
    }

    public function get_brand_json(Brand $brand)
    {
        $brandParts = $brand->parts()->with(['category', 'reviews'])->get();
        foreach ($brandParts as $part) {
            if (!$part->reviews->first()) {
                continue;
            }
            $ratings = [];
            foreach ($part->reviews as $review) {
                array_push($ratings, $review->rating);
            }
            $part->avgRating = round(collect($ratings)->avg());
        }

        return response()->json([
            'brand' => $brand,
            'brandParts' => $brandParts,
        ]);
    }

    public function get_category_json(Category $category)
    {
        $category = $category->load(['parts.brand', 'parts.reviews']);
        foreach ($category->parts as $part) {
            if (!$part->reviews->first()) {
                continue;
            }
            $ratings = [];
            foreach ($part->reviews as $review) {
                array_push($ratings, $review->rating);
            }
            $part->avgRating = round(collect($ratings)->avg());
        }
        return response()->json($category);
    }

    public function get_all_components()
    {
        $parts = Part::latest()->with(['category', 'brand', 'reviews'])->get()->toArray();
        foreach ($parts as $part) {
            if (!$part['reviews']) {
                continue;
            }
            $ratings = [];
            foreach ($part['reviews'] as $review) {
                array_push($ratings, $review['rating']);
            }
            $part->avgRating = round(collect($ratings)->avg());
        }
        // $partsXml = new SimpleXMLElement('<components/>');
        // arrayToXml($parts, $partsXml);
        // saveXMLAsFile($partsXml, 'components');

        return Storage::download('xml/components.xml');
    }

    public function get_all_brands()
    {
        $brands = Brand::latest()->get()->toArray();
        // $brandsXml = new SimpleXMLElement('<brands/>');
        // arrayToXml($brands, $brandsXml);
        // saveXMLAsFile($brandsXml, 'brands');

        return Storage::download('xml/brands.xml');
    }

    public function get_all_categories()
    {
        $categories = Category::latest()->with('parts')->get()->toArray();
        // $categoriesXml = new SimpleXMLElement('<categories/>');
        // arrayToXml($categories, $categoriesXml);
        // saveXMLAsFile($categoriesXml, 'categories');
        return Storage::download('xml/categories.xml');
    }

    public function get_component($part)
    {
        $part = Part::where('id', $part)->with(['category', 'reviews.user', 'brand', 'spec'])->first()->toArray();
        $partSpec = json_decode($part['spec']['properties'], true);

        // $partXml = new SimpleXMLElement('<component/>');
        // arrayToXml([
        //     'part' => $part,
        //     'partSpec' => $partSpec,
        // ], $partXml);
        // saveXMLAsFile($partXml, 'component');
        return Storage::download('xml/component.xml');
    }

    public function get_brand($brand)
    {
        $brand = Brand::where('id', $brand)->with(['parts.category', 'parts.reviews'])->first()->toArray();
        $brandParts = $brand['parts'];
        foreach ($brandParts as $part) {
            if (!$part['reviews']) {
                continue;
            }
            $ratings = [];
            foreach ($part['reviews'] as $review) {
                array_push($ratings, $review['rating']);
            }
            $part->avgRating = round(collect($ratings)->avg());
        }
        $brand = Brand::where('id', $brand)->first()->toArray();

        // $brandXml = new SimpleXMLElement('<brand/>');
        // arrayToXml([
        //     'brand' => $brand,
        //     'brandParts' => $brandParts,
        // ], $brandXml);
        // saveXMLAsFile($brandXml, 'brand');
        return Storage::download('xml/brand.xml');
    }

    public function get_category($category)
    {
        $category = Category::where('id', $category)->with(['parts.brand', 'parts.reviews'])->first()->toArray();
        foreach ($category['parts'] as $part) {
            if (!$part['reviews']) {
                continue;
            }
            $ratings = [];
            foreach ($part['reviews'] as $review) {
                array_push($ratings, $review['rating']);
            }
            $part['avgRating'] = round(collect($ratings)->avg());
        }
        $category = Category::where('id', $category)->first()->toArray();

        // $categoryXml = new SimpleXMLElement('<category/>');
        // arrayToXml($category, $categoryXml);
        // saveXMLAsFile($categoryXml, 'category');

        return Storage::download('xml/category.xml');
    }
}
