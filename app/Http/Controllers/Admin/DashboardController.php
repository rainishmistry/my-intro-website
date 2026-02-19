<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contactCount = \App\Models\Contact::count();
        $projectCount = \App\Models\Project::count();
        $recentContacts = \App\Models\Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('contactCount', 'projectCount', 'recentContacts'));
    }
}
