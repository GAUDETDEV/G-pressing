<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre_poste',
        'desc_poste',
        'salaire_poste',
        'id_user_auth',
    ];
}
