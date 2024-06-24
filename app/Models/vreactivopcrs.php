<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vreactivopcrs extends Model
{

    //^==============================================Datos de tabla

    protected $table = 'vreactivopcrs';
    protected $fillable = [
        'reactivo_id',
        'fecha_apertura',
        'user_id',
        'validacion',
        'reactivopcrs_id',
        'version',
    ];

    //^==============================================Relacion de usuarios
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion de bitacoras
    //&=====================================Pcr
    public function pcrs()
    {
        return $this->belongsToMany(pcr::class);
    }

    //^==============================================Relacion de Inventarios
    //&=====================================Reactivos
    public function reactivo()
    {
        return $this->belongsTo(reactivos::class);
    }

    use HasFactory;
}
