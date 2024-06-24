<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcrs_equipos extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'equipos_pcr';

    //^==============================================Relacion con equipos

    public function equipos()
    {
        return $this->belongsTo(equipos::class);
    }
    
    use HasFactory;
}
