<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipos_pcreal extends Model
{
    //^==============================================Datos de Tablas

    protected $table = 'equipos_pcreal';

    //^==============================================Relacion con equipo

    public function equipos()
    {
        return $this->belongsTo(equipos::class);
    }

    use HasFactory;
}
