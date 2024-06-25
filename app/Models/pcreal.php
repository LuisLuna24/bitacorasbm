<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcreal extends Model
{
    //^==============================================Datos de tabla
    
    protected $table = 'pcreals';
    protected $fillable = [
        'no_registro',
        "analisis_id",
        "fecha",
        "resultado",
        "sanitizo",
        "tiempouv",
        "observaciones",
        "user_id",
        "validacion",
        'version'
    ];

    //^==============================================Relacion con version pcreal

    public function vpcreals(){
        return $this->hasMany(vpcreals::class);
    }

    //^==============================================Relacion con usuarios
    
    public function user(){
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

    //^==============================================Relacion con bitacoras
    //&=====================================Reactivos pcreal
    public function rpcreals()
    {
        return $this->belongsToMany(reactivopcreals::class);
    }

    public function vrpcreals()
    {
        return $this->belongsToMany(vreactivopcreals::class);
    }



    use HasFactory;
}
