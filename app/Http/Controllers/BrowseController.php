<?php
// AUTHOR: CHAN ZHENG JIE / POH YUAN HAO

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Part;

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

    public function get_all_components()
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

    public function get_all_brands()
    {
        $brands = Brand::latest()->get();
        return response()->json($brands);
    }

    public function get_all_categories()
    {
        $categories = Category::latest()->with('parts')->get();
        return response()->json($categories);
    }

    public function get_component(Part $part)
    {
        $part = $part->load(['category', 'reviews.user', 'brand', 'spec']);
        $partSpec = json_decode($part->spec->properties);

        return response()->json([
            'part' => $part,
            'partSpec' => $partSpec,
        ]);
    }

    public function get_brand(Brand $brand)
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

    public function get_category(Category $category)
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
}
