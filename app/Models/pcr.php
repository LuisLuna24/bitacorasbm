<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr extends Model
{
    protected $table = 'pcrs';
    protected $fillable = [
        'id_usuario',
        'id_analisis',
        'no_registro',
        'sanitizo',
        'tiempouv',
        'agarosa',
        'tiempo',
        'voltaje',
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
