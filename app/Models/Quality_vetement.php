<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quality_vetement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description_quality',
        'id_gerant',
        'id_pack',
    ];
}
