<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_titulaire',
        'tel_titulaire',
        'id_type_depot',
        'avance',
        'montant',
        'reste',
        'etat_livraison',
        'statut_facture',
        'date_retrait',
        'etat_traitement',
        'id_editor',
        'id_company',
        'id_service',
        'registration',
    ];

}
