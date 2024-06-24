<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcrs_reactivopcr extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'pcr_reactivopcrs';

    //^==============================================Relacion de bitacoras
    //&=====================================Pcr
    public function pcr()
    {
        return $this->belongsTo(pcr::class);
    }

    //&=====================================Reactivos pcr

    public function reactivopcrs()
    {
        return $this->belongsTo(reactivopcrs::class);
    }

    use HasFactory;
}
