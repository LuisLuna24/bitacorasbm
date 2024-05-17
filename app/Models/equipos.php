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

    use HasFactory;
}
