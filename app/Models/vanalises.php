<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vanalises extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'vanalises';
    protected $fillable = [
        'nombre'
    ];

    //^==============================================Relacion con usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================RElacion con analisis

    public function analises()
    {
        return $this->belongsTo(analises::class);
    }

    use HasFactory;
}
