<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch settings as key-value pair
        $settings = \App\Models\Setting::all()->pluck('value', 'key')->toArray();
        
        // Fetch projects
        $projects = \App\Models\Project::latest()->get();

        return view('home', compact('settings', 'projects'));
    }
}
