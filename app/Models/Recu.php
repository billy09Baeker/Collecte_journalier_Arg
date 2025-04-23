<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recu extends Model
{
    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'numero_recu',
        'paiement_id',
        'date_emission',
    ];

    public $timestamps = true;
    
    // Define the relationship with the Paiement model
    public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'paiement_id');
    }
}
