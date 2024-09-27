<?php

namespace App\Http\Controllers;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 

class DonationController extends Controller
{

    public function index(): View
    {
        // Retrieve donations for the authenticated user
    $donations = Donation::whereHas('campaign', function ($query) {
        $query->where('id', auth()->id());
    })->get();

    return view('donations.index', compact('donations'));
    }

    public function store(Request $request, Campaign $campaign): RedirectResponse // Change this line
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);
    
        // Check if the campaign is open and can accept more donations
        if (!$campaign->isOpen()) {
            return response('Campaign is closed or target has been reached.', 400);
        }
    
        // Create a new donation
        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'amount' => $request->input('amount'),
            'status' => 'pending',
        ]);
    
        // Update the campaign's current amount
        $campaign->current_amount += $donation->amount;
    
        // Check if the campaign has reached its target
        if ($campaign->hasReachedTarget()) {
            // Mark the campaign as complete
            $campaign->markAsComplete();
            
            // Mark all donations as complete
            Donation::where('campaign_id', $campaign->id)
                ->update(['status' => 'completed']);
        } else {
            // Otherwise, mark the donation as complete individually
            $donation->markAsComplete();
        }
    
        // Save the updated campaign amount
        $campaign->save();
    
        // Redirect to the campaigns index page with a success message
        return redirect()->route('campaigns.index')->with('success', 'Donation successful!');
    }
    

    public function showDonateForm(Campaign $campaign): View
{
    // Pass the campaign to the donation view
    return view('donations.donate', compact('campaign'));
}
}
