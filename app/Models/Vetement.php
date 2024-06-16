<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vetement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_vet',
        'prix_vet',
        'id_cat_vet',
        'id_editor',
        'id_service',
        'id_pack',
        'id_quality_vet',
    ];
}
