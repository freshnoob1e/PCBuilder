<?php

namespace App\Http\Controllers;

use App\Models\PartSpec;
use Illuminate\Http\Request;

class PartSpecController extends Controller
{
    public function index(){
        $partSpecs = PartSpec::latest()->with('part')->get();
        foreach ($partSpecs as $spec) {
            $spec->props = json_decode($spec->properties);
        }
        return view('part_specs.index', [
            'partSpecs' => $partSpecs
        ]);
    }
}
