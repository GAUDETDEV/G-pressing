<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_pack',
        'prix_pack',
        'avantage_pack',
        'nbr_vet',
        'poids_vet',
        'duration_pack',
        'id_editor',
        'delivery',
        'recovery',
    ];

}
