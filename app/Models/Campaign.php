<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['name', 'target_amount', 'current_amount', 'status']; 

    // Check if the campaign is still open
    public function isOpen()
    {
        return $this->status === 'open' && $this->current_amount < $this->target_amount;
    }

    // Check if the campaign has reached its target amount
    public function hasReachedTarget()
    {
        return $this->current_amount >= $this->target_amount;
    }

    // Mark the campaign as complete
    public function markAsComplete()
    {
        $this->status = 'completed';
        $this->save();
    }
}
