<?php

namespace App\Http\Controllers;

use App\Models\Campaign; // Import the Campaign model

class HomeController extends Controller
{
    public function welcome()
    {
        // Fetch all campaigns
        $campaigns = Campaign::all();

        // Pass campaigns to the view
        return view('welcome', compact('campaigns'));
    }
}
