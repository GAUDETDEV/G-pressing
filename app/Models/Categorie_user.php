<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie_user extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom_cat_user',
    ];

}
