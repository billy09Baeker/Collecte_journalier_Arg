<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    ///** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        "name",
        "email",
        "email_verified_at",
        "password",
        "solde",

    ];
    protected $hidden = [
        "password",
        "rememberToken",
    ];
    protected $casts = [
        'email_verified_at'=> 'datetime',
    ];
    public function collecteur(){
        return $this->belongsTo(Collecteur::class);
    }
}