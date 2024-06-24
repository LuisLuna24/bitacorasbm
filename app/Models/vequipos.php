<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vequipos extends Model
{

    //^==============================================Datos de tabla

    protected $table = 'vequipos';
    protected $fillable = [
        'user_id',
        'inventario',
        'nombre',
        'descripcion',
        'estado',
    ];

    //^==============================================Relacion con usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con equipos

    public function equipo()
    {
        return $this->belongsTo(equipos::class);
    }

    use HasFactory;
}
