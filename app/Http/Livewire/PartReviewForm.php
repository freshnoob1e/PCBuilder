<?php
// AUTHOR: ONG CHOON TECK / POH YUAN HAO

namespace App\Http\Livewire;

use App\Models\PartReview;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PartReviewForm extends Component
{
    public $part;
    public $rating;
    public $text;

    public function rules()
    {
        return [
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'text' => ['required', 'string'],
        ];
    }

    public function mount()
    {
        $this->rating = 3;
    }

    public function changeRating($number)
    {
        $this->rating = $number;
    }

    public function post()
    {
        $this->validate();
        if (!Auth::check()) {
            abort(401, 'User unauthorized');
        }
        $userId = Auth::user()->id;
        $partId = $this->part->id;

        PartReview::create([
            'part_id' => $partId,
            'user_id' => $userId,
            'rating' => $this->rating,
            'text' => $this->text,
        ]);

        return redirect()->route('show-component', $partId);
    }

    public function render()
    {
        return view('livewire.part-review-form');
    }
}
