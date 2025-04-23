<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'montant',
        'date_paiement',
        'mode_paiement',
        'client_id',
        'collecteur_id',
        'methode_paiement',
    ];

    public $timestamps = true;
    
    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'client_id');
    }

    public function collecteur()
    {
        return $this->belongsTo(Utilisateur::class, 'collecteur_id');
    }

    public function recu()
    {
        return $this->hasOne(Recu::class, 'paiement_id');
    }
}
