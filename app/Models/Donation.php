<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['campaign_id', 'amount', 'status']; 

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    // Mark the donation as complete
    public function markAsComplete()
    {
        $this->status = 'completed';
        $this->save();
    }
}
