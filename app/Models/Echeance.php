<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Echeance extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant_journalier',
        'date_paiement',
        'date_echeance',
    ];
}
