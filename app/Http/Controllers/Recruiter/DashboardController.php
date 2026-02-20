<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // For now, just return a simple view
        return view('recruiter.dashboard.index');
    }   
}
