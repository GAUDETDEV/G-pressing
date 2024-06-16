<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recept extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_vet',
        'color_vet',
        'caract_vet',
        'cat_vet',
        'quality_vet',
        'qte_vet',
        'prix_unitaire',
        'prix',
        'id_facture',
        'id_type_depot',
        'id_receptionist',
        'id_company',
        'id_service',
        "nom_client",
        "tel_client",
        'registration',
    ];

}
