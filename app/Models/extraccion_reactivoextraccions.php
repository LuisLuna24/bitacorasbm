<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extraccion_reactivoextraccions extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'extraccion_reactivoextraccions';

    //^==============================================Relacion de bitacoras
    //&=====================================Pcr
    public function extraccion()
    {
        return $this->belongsTo(extraccion::class);
    }

    //&=====================================Reactivos pcr

    public function reactivoextraccions()
    {
        return $this->belongsTo(reactivoextraccions::class);
    }

    use HasFactory;
}
