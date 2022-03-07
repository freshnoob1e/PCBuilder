<?php

namespace App\Http\Controllers;

use App\Models\PartRating;
use App\Models\PartReview;
use Illuminate\Http\Request;

class PartReviewController extends Controller
{
    public function index(){
        $partReviews = PartReview::latest()->with(['part', 'user', 'rating']);
        return view('part_reviews.index', ['partReviews' => $partReviews]);
    }

    public function create(){
        return view('part_reviews.create');
    }

    public function store(Request $req){
        $req->validate([
            'part_id' => ['required', 'exists:parts,id'],
            'user_id' => ['required', 'exists:users,id'],
            'text' => ['required', 'string'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5']
        ]);

        $newReview = PartReview::create([
            'part_id' => $req->part_id,
            'user_id' => $req->user_id,
            'text' => $req->text
        ]);

        PartRating::create([
            'part_review_id' => $newReview->id,
            'rating' => $req->rating
        ]);

        return redirect()->route('parts-show', $req->part_id);
    }

    public function destroy(PartReview $partReview){
        $partReview->delete();
    }
}
