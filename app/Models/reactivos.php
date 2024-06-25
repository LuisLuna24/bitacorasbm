<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivos extends Model
{

    //^==============================================Datos de tabla

    protected $table = 'reactivos';
    protected $fillable = [
        'nombre',
        'description',
        'lote',
        'existencia',
        'fecha_caducidad',
        'user_id'
    ];

    //^==============================================Relacion con version reactivos

    public function vreactivos()
    {
        return $this->hasMany(vreactivos::class);
    }

    //^==============================================Relacion con usuarios

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con bitacoras
    //&=====================================Reactivos pcr

    public function reactivopcr()
    {
        return $this->belongsToMany(reactivopcrs::class);
    }

    //&=====================================Reactivos pcreal

    public function reactivopcreal()
    {
        return $this->belongsToMany(reactivopcrs::class);
    }

    //&=====================================Reactivos extraccion

    public function reactivoextraccion()
    {
        return $this->belongsToMany(reactivoextraccions::class);
    }

    //&=====================================version reactivos pcr

    public function vreactivopcrs()
    {
        return $this->belongsToMany(vreactivopcrs::class);
    }

    //&=====================================version reactivos pcreal

    public function vreactivopcreals()
    {
        return $this->belongsToMany(vreactivopcreals::class);
    }

    //&=====================================version reactivos extraccion

    public function vreactivoextraccions()
    {
        return $this->belongsToMany(vreactivoextraccions::class);
    }

    use HasFactory;
}
