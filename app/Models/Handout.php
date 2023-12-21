<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Handout extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

}
