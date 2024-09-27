<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    // Display a listing of the campaigns
    public function index()
    {
        $campaigns = Campaign::all(); // Fetch all campaigns from the database
        return view('campaigns.index', compact('campaigns')); // Pass campaigns to the view
    }

    // Show the form for creating a new campaign
    public function create()
    {
        return view('campaigns.create'); // Return the view to create a new campaign
    }

    // Store a newly created campaign in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
        ]);

        // Create a new campaign
        Campaign::create([
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'current_amount' => 0,  // Initialize current amount to 0
            'status' => 'open',  // Set initial status to open
            // 'user_id' => auth()->id(), // Assuming you have user authentication
        ]);

        return redirect()->route('campaigns.index')->with('success', 'Campaign created successfully!');
    }

    public function show($id)
{
    // Retrieve the campaign by its ID
    $campaign = Campaign::findOrFail($id);

    // Return the view with the campaign data
    return view('campaigns.show', compact('campaign'));
}

    // Other methods can be defined here (show, edit, update, destroy)
}
