<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_tache',
        'etat_tache',
        'debut_tache',
        'fin_tache',
        'id_executant',
        'id_facture',
        'id_create_tache',
    ];

}
