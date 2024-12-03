<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extraccion extends Model
{
    protected $table = 'extraccions';
    protected $fillable = [
        'id_usuario',
        'id_analisis',
        'no_registro',
        'sanitizo',
        'tiempouv',
        'cong_ng_ul',
        'dato_260_280',
        'dato_260_230',
        'version',
        'estado',
    ];

    public function analisis(){
        return $this->belongsTo(analises::class, 'id_analisis');
    }
    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
    
    use HasFactory;
}
