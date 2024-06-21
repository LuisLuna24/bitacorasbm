<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vpcrs extends Model
{
    protected $table = 'vpcrs';

    protected $fillable = [
        'no_registro',
        'fecha',
        'analisis_id',
        'resultado',
        'agarosa',
        'voltaje',
        'tiempo',
        'sanitizo',
        'tiempouv',
        'version',
        'pcr_id',
        'user_id',
    ];

    //muchos a uno

    public function pcrs()
    {
        return $this->hasMany(pcr::class);
    }

    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }

    //RElacion con usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    // relacion con especies
    public function especies(){
        return $this->belongsToMany(especies::class);
    }

    // relacion con equipos
    public function equipos(){
        return $this->belongsToMany(equipos::class);
    }


    use HasFactory;
}
