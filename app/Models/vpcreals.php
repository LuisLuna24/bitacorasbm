<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vpcreals extends Model
{

    //^==============================================Datos de tabla

    protected $table = 'vpcreals';
    protected $fillable = [
        'pcreal_id',
        'user_id',
        'no_registro',
        'fecha',
        'analisis_id',
        'sanitizo',
        'tiempouv',
        'resultado',
        'observaciones',
        'validacion',
        'version'
    ];

    //^==============================================Relacion con usuario

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con bitacoras
    //&=====================================Vercion Pcreal
    public function pcreals()
    {
        return $this->hasMany(pcreal::class);
    }

    //^==============================================Relacion con catalogos
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

    //^==============================================Relacion con inventarios
    //&=====================================Equipos
    public function equipos()
    {
        return $this->belongsToMany(equipos::class);
    }

    use HasFactory;
}
