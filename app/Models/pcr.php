<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'pcrs';
    protected $fillable = [
        'no_registro',
        'analisis_id',
        'fecha',
        'resultado',
        'agarosa',
        'voltaje',
        'tiempo',
        'sanitizo',
        'tiempouv',
        'user_id',
        'validacion',
        'version'
    ];

    //^==============================================Relacion con versiones de pcr

    public function vpcrs()
    {
        return $this->hasMany(vpcrs::class);
    }

    //^==============================================Relacion con usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con inventarios
    //&=====================================Equipos

    public function equipos()
    {
        return $this->belongsToMany(equipos::class);
    }

    //^==============================================Relacion con catalogos
    //&=====================================Especies

    public function especies()
    {
        return $this->belongsToMany(especies::class);
    }

    //&=====================================Analisis

    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }

    //^==============================================Relacion con bitacora de reactivos


    public function rpcrs()
    {
        return $this->belongsToMany(reactivopcrs::class);
    }

    public function vrpcrs()
    {
        return $this->belongsToMany(vreactivopcrs::class);
    }


    use HasFactory;
}
