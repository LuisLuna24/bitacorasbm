<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vpcreals extends Model
{
    protected $table = 'vpcreals';

    protected $fillable = [
        'pcreal_id',
        'user_id',
        'no_registro',
        'fecha',
        'analisis_id',
        'sanitizo',
        'tiempouv',
        'resultado',
        'observaciones',
        'validacion',
        'version'
    ];

    public function pcreals()
    {
        return $this->hasMany(pcreal::class);
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
