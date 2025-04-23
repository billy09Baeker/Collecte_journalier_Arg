<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{

    use HasApiTokens;
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'email',
        'telephone',
        'adresse',
        'password',
        'role',
        'added_by'
    ];

    protected $hidden = [
        "password",
        "remember_token",
    ];


    public $timestamps = true;


    // Add this method to the Utilisateurs class
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function clientsAjoutes()
    {
        return $this->hasMany(Utilisateur::class, 'added_by')->where('role', 'client');
    }

    public function ajouterPar()
    {
        return $this->belongsTo(Utilisateur::class, 'added_by');
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class, 'client_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }
}
