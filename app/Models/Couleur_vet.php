<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couleur_vet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_couleur_vet',
        'id_editor',
    ];
}
