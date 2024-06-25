<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivoextraccions extends Model
{
    //^==============================================Datos de tabla
    protected $table ='reactivoextraccions';
    protected $fillable = [
        'reactivo_id',
        'fecha_apertura',
        'user_id',
        'validacion',
        'version',
    ];

    //^==============================================Relacion con usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con inventarios
    //&=====================================Reactivos

    public function reactivo()
    {
        return $this->belongsTo(reactivos::class);
    }

    //^==============================================Relacion con bitacoras
    //&=====================================Pcr
    public function extraccions()
    {
        return $this->belongsToMany(extraccion::class);
    }
    
    use HasFactory;
}
