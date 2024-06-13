<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extraccion extends Model
{
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
        'user_id'

    ];

    
    //relacion muchos a muchos con equipos
    public function equipos()
    {
        return $this->belongsToMany(equipos::class);
    }

    //uno a uno
    
    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }

    public function metodo()
    {
        return $this->belongsTo(metodos::class);
    }

    //relacion con usuarios
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
