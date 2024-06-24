<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipos extends Model
{
    //^==============================================Datos de Tablas
    protected $table = 'equipos';
    protected $fillable = [
        'user_id',
        'inventario',
        'nombre',
        'descripcion',
        'estado',
    ];

    //^==============================================Relacion con usuarios

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con version equipos

    public function vequipos()
    {
        return $this->hasMany(vequipos::class);
    }

    //^==============================================Relacion con bitacoras
    //&=====================================Pcr
    public function pcr()
    {
        return $this->belongsToMany(pcr::class);
    }

    public function pcrs_equipos()
    {
        return $this->hasMany(pcrs_equipos::class);
    }

    public function vpcrs()
    {
        return $this->belongsToMany(vpcrs::class);
    }

    public function equipos_vpcr()
    {
        return $this->hasMany(equipos_vpcr::class);
    }

    //&=====================================Pcreal
    public function pcreals()
    {
        return $this->belongsToMany(pcreal::class);
    }

    public function equipos_pcreal()
    {
        return $this->hasMany(equipos_pcreal::class);
    }

    public function vpcreals()
    {
        return $this->belongsToMany(vpcreals::class);
    }

    public function equipos_vpcreal()
    {
        return $this->hasMany(equipos_vpcreals::class);
    }

    //&=====================================Extraccion

    public function extracion()
    {
        return $this->belongsToMany(extraccion::class);
    }

    public function equipos_extraccion()
    {
        return $this->hasMany(equipos_extraccion::class);
    }

    public function vextracion()
    {
        return $this->belongsToMany(vextraccion::class);
    }








    use HasFactory;
}
