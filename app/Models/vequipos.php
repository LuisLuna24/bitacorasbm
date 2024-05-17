<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vequipos extends Model
{
    protected $table = 'vequipos';

    protected $fillable = [
        'user_id',
        'inventario',
        'nombre',
        'descripcion',
        'estado',
    ];

    //muchos a uno
    public function equipo(){
        return $this->belongsTo(equipos::class);
    }

    //usuario a anamises
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
