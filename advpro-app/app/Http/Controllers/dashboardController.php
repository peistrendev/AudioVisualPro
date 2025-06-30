<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// No need for 'use App\Models\;' unless you actually use a model directly here.

class DashboardController extends Controller
{
    /**
     * Display the application dashboard.
     * This method is typically protected by the 'auth' middleware.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // If you need to pass data to the dashboard, you would fetch it here.
        // Example: $usersCount = \App\Models\User::count();
        // return view('inicio.dashboard', compact('usersCount'));

        return view('inicio.dashboard');
    }

    // Removed store, edit, update, destroy methods as they are typically
    // for resource controllers managing specific models, not the dashboard itself.
    // Add them back only if your dashboard directly manages a specific resource
    // and these methods are strictly for that.
}