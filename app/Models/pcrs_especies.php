<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcrs_especies extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'especies_pcr';

    //^==============================================Relacion con especies

    public function especies()
    {
        return $this->belongsTo(especies::class);
    }

    use HasFactory;
}
