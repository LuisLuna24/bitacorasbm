<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vreactivopcreals extends Model
{

    //^==============================================Datos de tabla

    protected $table = 'vreactivopcreals';
    protected $fillable = [
        'reactivopcreals_id',
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
    //&=====================================Pcreal
    public function pcreals()
    {
        return $this->belongsToMany(pcreal::class);
    }

    //^==============================================Relacion de Inventarios
    //&=====================================Reactivos
    public function reactivo()
    {
        return $this->belongsTo(reactivos::class);
    }

    use HasFactory;
}
