<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcreal extends Model
{
    protected $table = 'pcreals';

    protected $fillable = [
        'no_registro',
        "analisis_id",
        "fecha",
        "resultado",
        "sanitizo",
        "tiempouv",
        "observaciones",
        "user_id",
        "validacion",
    ];

    public function equipos()
    {
        return $this->belongsToMany(equipos::class);
    }

    public function especies()
    {
        return $this->belongsToMany(especies::class);
    }

    //uno a uno
    
    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }

    //relacion con usuarios
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function vpcreals(){
        return $this->hasMany(vpcreals::class);
    }

    use HasFactory;
}
