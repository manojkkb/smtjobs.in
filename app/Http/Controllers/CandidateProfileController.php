<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidateProfileController extends Controller
{
    public function show()
    {
        return view('candidate.profile');
    }
}
