<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extraccion_equipos extends Model
{
    protected $table = 'extraccion_equipos';
    protected $fillable = [
        'id_extraccion',
        'id_equipo',
    ];

    public function equipos(){
        return $this->belongsTo(equipos::class, 'id_equipo', 'id');
    }

    //extraccions
    public function extraccions(){
        return $this->belongsTo(extraccion::class, 'id_extraccion', 'id');
    }

    use HasFactory;
}
