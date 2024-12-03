<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class version_equipos extends Model
{
    protected $table ='version_equipos';
    protected $fillable = ['id_equipo','no_inventario','no_inventario_anterior','nombre','nombre_anterior','descripcion','descripcion_anterior','razon_cambio','id_usuario'];

    public function equipo(){
        return $this->belongsTo(equipos::class, 'id_equipo', 'id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
    use HasFactory;
}
