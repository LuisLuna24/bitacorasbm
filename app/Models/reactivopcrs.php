<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivopcrs extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'reactivopcrs';
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
    public function pcrs()
    {
        return $this->belongsToMany(pcr::class);
    }


    use HasFactory;
}
