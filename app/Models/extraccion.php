<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extraccion extends Model
{
    //^==============================================Datos de Tablas

    protected $table = 'extraccions';
    protected $fillable = [
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

    //^==============================================Relacion con versiones extraccion

    public function vextraccions()
    {
        return $this->hasMany(vextraccion::class);
    }

    //^==============================================Relacion con usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
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
