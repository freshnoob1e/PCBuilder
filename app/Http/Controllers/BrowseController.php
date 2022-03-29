<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Part;

class BrowseController extends Controller
{
    public function components_index()
    {
        $parts = Part::latest()->with(['category', 'brand', 'reviews'])->get();
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
}
