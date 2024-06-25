<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vextraccion extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'vextraccions';
    protected $fillable = [
        'extraccion_id',
        'no_registro',
        'fecha',
        'analisis_id',
        'metodo_id',
        'user_id',
        'conc_ng_ul',
        'dato260_280',
        'dato260_230',
        'validacion',
        'user_id',
        'version',
    ];

    //^==============================================Relacion con usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con extraccion

    public function extraccion()
    {
        return $this->hasMany(extraccion::class);
    }

    //^==============================================Relacion con inventarios
    //&=====================================Equipos
    public function equipos()
    {
        return $this->belongsToMany(equipos::class);
    }

    //^==============================================Relacion con catalogos
    //&=====================================Analisis

    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }

    //&=====================================Metodos

    public function metodo()
    {
        return $this->belongsTo(metodos::class);
    }

    use HasFactory;
}
