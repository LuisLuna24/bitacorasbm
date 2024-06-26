<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vmetodos extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'vmetodos';
    protected $fillable = [
        'nombre',
        'user_id',
        'version',
        'metodo_id',
    ];

    //^==============================================Relacion con usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con metodos
    public function metodos()
    {
        return $this->belongsTo(metodos::class);
    }

    use HasFactory;
}
