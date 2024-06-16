<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification_vet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_specification_vet',
        'id_editor',
    ];

}
