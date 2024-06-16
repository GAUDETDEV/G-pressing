<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_adresse',
        'id_editor',
        'id_company',
    ];
}
