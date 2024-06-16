<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_destinataire',
        'tel_destinataire',
        'date_livraison',
        'heure_livraison',
        'registration',
        'frais',
        'id_commune',
        'id_quartier',
        'id_adresse',
        'id_prix',
        'id_facture',
        'id_delivery',
        'id_company',
    ];
}
