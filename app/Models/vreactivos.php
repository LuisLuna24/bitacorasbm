<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vreactivos extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'vreactivos';
    protected $fillable = [
        'nombre',
        'description',
        'lote',
        'existencia',
        'fecha_caducidad',
        'user_id',
        'version',
        'reactivo_id'
    ];

    //^==============================================Relacion de usuarios

    public function user(){
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion de inventarios
    //&=====================================Reactivossd
    public function reactivo(){
        return $this->belongsTo(reactivos::class);
    }

    use HasFactory;
}
