<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vpcrs extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'vpcrs';
    protected $fillable = [
        'no_registro',
        'fecha',
        'analisis_id',
        'resultado',
        'agarosa',
        'voltaje',
        'tiempo',
        'sanitizo',
        'tiempouv',
        'version',
        'pcr_id',
        'user_id',
    ];

    //^==============================================Datos de usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion de bitacoras
    //&=====================================Pcr
    public function pcrs()
    {
        return $this->hasMany(pcr::class);
    }

    //^==============================================Relacion de catalogos
    //&=====================================Analisis
    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }

    //&=====================================Especies

    public function especies()
    {
        return $this->belongsToMany(especies::class);
    }

    //^==============================================Relacion de inventarios
    //&=====================================Equipos
    public function equipos()
    {
        return $this->belongsToMany(equipos::class);
    }

    use HasFactory;
}
