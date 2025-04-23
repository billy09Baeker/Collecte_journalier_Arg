<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'titre',
        'message',
        'type',
        'user_id',
        'read_at',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(Utilisateur::class, 'user_id');
    }
}
