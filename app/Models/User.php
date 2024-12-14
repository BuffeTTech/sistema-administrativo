<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'document',
        'document_type',
        'phone1',
        'phone2',
        'address',
        'status',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function representative() {
        return $this->hasOne(User::class);
    }
    public function commercial() {
        return $this->hasOne(User::class);
    }

    public function user_phone1() {
        return $this->belongsTo(Phone::class, 'phone1');
    }
    public function user_phone2() {
        return $this->belongsTo(Phone::class, 'phone2');
    }
    public function user_address() {
        return $this->belongsTo(Address::class, 'address');
    }
    public function buffets() {
        return $this->hasMany(Buffet::class, 'owner_id');
    }

    public function isBuffet(){
        return $this->hasRole('buffet');
    }


    // public function getPassword()
    // {
    //     // Usado para compartilhamento de senha entre sistemas
    //     $this->setHidden([]);

    //     $password = $this->password;

    //     $this->setHidden(['password', 'remember_token']);

    //     return $password;
    // }

    /**
     * Retorna a chave primária do JWT (geralmente o ID do usuário).
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Retorna as claims adicionais que você deseja adicionar ao payload do JWT.
     */
    public function getJWTCustomClaims()
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'document'=>$this->document,
            'status'=>$this->status,
        ];
    }

}
