<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipos_vextraccion extends Model
{
    //^==============================================Datos de Tablas

    protected $table = 'equipos_vextraccion';

    //^==============================================Relacion con equipos

    public function equipos()
    {
        return $this->belongsTo(equipos::class);
    }

    use HasFactory;
}
