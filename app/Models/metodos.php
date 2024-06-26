<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodos extends Model
{
    //^==============================================Datos de tabla
    protected $table = 'metodos';
    protected $fillable = [
        'nombre',
        'user_id',
        'version'
    ];

    //^==============================================Relacion con versiones de metodos

    public function vmetodos()
    {
        return $this->hasMany(vmetodos::class);
    }

    //^==============================================Relacion con usuarios

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con bitacoras
    //&=====================================extraccion
    public function extraccion()
    {
        return $this->belongsToMany(extraccion::class);
    }

    public function vextraccion()
    {
        return $this->belongsToMany(vextraccion::class);
    }



    use HasFactory;
}
