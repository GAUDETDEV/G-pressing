<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formule extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_formule',
        'prix_formule',
        'nbr_user',
        'nbr_essai',
        'periode',
        'fonctionnalite',
        'id_etat_formule',
    ];


}
