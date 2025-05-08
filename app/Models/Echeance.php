<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Echeance extends Model
{
    use HasFactory;



    protected $casts = [
    'date_paiement' => 'date',
];

    protected $fillable = [
        'montant_journalier',
        'date_paiement',
        'date_echeance',
        'mode_paiement_1',
        'qr_code_1',
        'mode_paiement_2',
        'qr_code_2',
    ];
}
