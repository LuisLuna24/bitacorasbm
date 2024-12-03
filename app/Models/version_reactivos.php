<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class version_reactivos extends Model
{
    protected $table ='version_reactivos';
    protected $fillable = ['id_reactivo','lote','lote_anterior','nombre','nombre_anterior','descripcion','descripcion_anterior','stock','stock_anterior','caducidad','caducidad_anterior','id_usuario'];
    
    public function reactivo()
    {
        return $this->belongsTo(reactivos::class, 'id_reactivo', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
    use HasFactory;
}
