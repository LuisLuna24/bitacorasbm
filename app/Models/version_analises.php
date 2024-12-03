<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class version_analises extends Model
{
    protected $table ='version_analises';
    protected $fillable = ['id_analisis','nombre','nombre_anterior','razon_cambio','id_usuario'];

    //analises
    public function analises(){
        return $this->belongsTo(analises::class, 'id_analisis');
    }
    //usuario
    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
    use HasFactory;
}
