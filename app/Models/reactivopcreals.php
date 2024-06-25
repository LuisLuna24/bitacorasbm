<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivopcreals extends Model
{
    //^==============================================Datos de tabla
    protected $table ='reactivopcreals';
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
    public function pcreals()
    {
        return $this->belongsToMany(pcreal::class);
    }
    use HasFactory;
}
