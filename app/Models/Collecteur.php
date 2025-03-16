<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Collecteur extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        "name",
        "email",
        "password",
        "email_verified_at",
    ];
    protected $hidden = [
        'password',
        'rememberToken',

    ];
    protected $casts = [
        'email_verified_at'=> 'datetime',
    ];
    public function client(){
        return $this->hasMany(Client::class);
    }
    
}
