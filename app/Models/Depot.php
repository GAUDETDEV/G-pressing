<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_depot',
        'nbr_vet',
        'poids_vet',
        'prix_depot',
        'id_company',
        'id_receptionist',
    ];

}
