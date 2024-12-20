<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class version_metodos extends Model
{
    protected $table ='version_metodos';
    protected $fillable = ['id_metodo','nombre','nombre_anterior','razon_cambio','id_usuario'];

    //metodos
    public function metodos(){
        return $this->belongsTo(metodos::class, 'id_metodo', 'id');
    }

    //usuarios
    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
    use HasFactory;
}
