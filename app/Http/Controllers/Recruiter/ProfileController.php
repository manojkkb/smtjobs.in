<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('recruiter.profile.show');
    }
}
