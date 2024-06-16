<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie_vet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_cat_vet',
        'id_editor',
        'id_pack',
    ];
}
