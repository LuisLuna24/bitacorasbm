<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipos extends Model
{

    protected $table = 'equipos';
    protected $fillable = [
        'user_id',
        'inventario',
        'nombre',
        'descripcion',
        'estado',
    ];

    //relacion muchos a uno
    public function User(){
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos con vanalises
    public function vequipos(){
        return $this->hasMany(vequipos::class);
    }

    //relacion inversa muchos a muchos con pcrs
    public function pcr()
    {
        return $this->belongsToMany(pcr::class);
    }

    public function pcrs_equipos()
    {
        return $this->hasMany(pcrs_equipos::class);
    }

    public function equipos_extraccion()
    {
        return $this->hasMany(equipos_extraccion::class);
    }


    public function extracion()
    {
        return $this->belongsToMany(extraccion::class);
    }

    use HasFactory;
}
