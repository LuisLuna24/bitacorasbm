<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class analises extends Model
{
    //^==============================================Datos de Tablas

    protected $table = 'analises';
    protected $fillable = [
        'nombre',
        'user_id',
        'version'
    ];

    //^==============================================Relacion con usuarios 
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con bitacoras
    //&=====================================Pcr

    public function pcr()
    {
        return $this->hasMany(pcr::class);
    }

    public function vpcr()
    {
        return $this->hasMany(vpcrs::class);
    }
    //&=====================================Pcreal

    public function pcreal()
    {
        return $this->hasMany(pcreal::class);
    }

    public function vpcreal()
    {
        return $this->hasMany(vpcreals::class);
    }
    //&=====================================Extraccion

    public function extraccion()
    {
        return $this->hasMany(extraccion::class);
    }

    public function vextraccion()
    {
        return $this->hasMany(vextraccion::class);
    }

    //^==============================================Version Analisis

    public function vanalises()
    {
        return $this->hasMany(vanalises::class);
    }

    use HasFactory;
}
