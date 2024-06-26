<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especies extends Model
{
    //^==============================================Datos de Tablas
    protected $table = 'especies';
    protected $fillable = [
        'nombre',
        'user_id',
        'version',
    ];

    //^==============================================Relacion con version especies

    public function vespecies()
    {
        return $this->hasMany(vespecies::class);
    }

    //^==============================================Relacion con usuarios 
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con bitacoras
    //&=====================================Pcr
    public function pcr()
    {
        return $this->belongsToMany(pcr::class);
    }

    public function pcrs_especies()
    {
        return $this->hasMany(pcrs_especies::class);
    }

    public function vpcrs()
    {
        return $this->belongsToMany(vpcrs::class);
    }

    public function especies_vpcr()
    {
        return $this->hasMany(especies_vpcr::class);
    }

    //&=====================================Pcreals

    public function pcreal()
    {
        return $this->belongsToMany(pcreal::class);
    }

    public function pcreals_especies()
    {
        return $this->hasMany(especies_pcreal::class);
    }

    public function vpcreals()
    {
        return $this->belongsToMany(vpcreals::class);
    }

    public function especies_vpcreal()
    {
        return $this->hasMany(especies_vpcreals::class);
    }



    use HasFactory;
}
