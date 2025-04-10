<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function buffet() {
        return $this->belongsTo(Buffet::class);
    }
    public function schedule() {
        return $this->belongsTo(BuffetSchedule::class, 'schedule_id');
    }
}
