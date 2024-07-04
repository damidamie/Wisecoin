<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

// Set default timezone
date_default_timezone_set('Asia/Jakarta');
class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'target_date',
        'item_name',
        'price',
    ];

    public function getDailySavingAttribute()
    {
        $daysLeft = Carbon::now()->diffInDays(Carbon::parse($this->target_date), false);
        return $daysLeft > 0 ? round($this->price / $daysLeft) : $this->price;
    }
}
