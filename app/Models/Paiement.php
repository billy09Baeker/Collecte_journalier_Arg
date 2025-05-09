<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;


    protected $casts = [
        'date_echeance' => 'date',
    ];

    protected $fillable = [
        'montant',
        'date_paiement',
        'mode_paiement',
        'client_id',
        'collecteur_id',
        'status',
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
