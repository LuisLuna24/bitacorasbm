<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcreal_reactivopcreals extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'pcreal_reactivopcreals';

    //^==============================================Relacion de bitacoras
    //&=====================================Pcr
    public function pcreal()
    {
        return $this->belongsTo(pcreal::class);
    }

    //&=====================================Reactivos pcr

    public function reactivopcreals()
    {
        return $this->belongsTo(reactivopcreals::class);
    }

    use HasFactory;
}
