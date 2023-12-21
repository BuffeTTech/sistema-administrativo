<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buffet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function owner(){
        return $this->belongsto(User::class, 'owner_id');
    }

    public function buffet_phone1() {
        return $this->belongsTo(Phone::class, 'phone1');
    }
    public function buffet_phone2() {
        return $this->belongsTo(Phone::class, 'phone2');
    }
    public function buffet_address() {
        return $this->belongsTo(Address::class);
    }
}
