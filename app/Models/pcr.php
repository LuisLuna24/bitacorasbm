<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr extends Model
{
    protected $table = 'pcrs';
    protected $fillable = [
        'id_usuario',
        'id_analisis',
        'no_registro',
        'sanitizo',
        'tiempouv',
        'agaroza',
        'tiempo',
        'voltaje',
        'version',
        'estado',
    ];

    public function analisis(){
        return $this->belongsTo(analises::class, 'id_analisis');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    //equipos
    public function equipos(){
        return $this->belongsToMany(equipos::class, 'pcr_equipos', 'id_pcr', 'id_equipo');
    }

    //especies
    public function especies(){
        return $this->belongsToMany(especies::class, 'pcr_especies', 'id_pcr', 'id_especie');
    }

    //validacion
    public function validacion(){
        return $this->hasOne(pcr_validacions::class, 'id_pcr');
    }

    use HasFactory;
}
