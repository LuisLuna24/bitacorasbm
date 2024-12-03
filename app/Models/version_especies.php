<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class version_especies extends Model
{
    protected $table ='version_especies';
    protected $fillable = ['id_epsecie','nombre','nombre_anterior','razon_cambio','id_usuario'];

    public function especie(){
        return $this->belongsTo(especies::class, 'id_epsecie', 'id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
    
    use HasFactory;
}
