<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vextraccion extends Model
{
    protected $table = 'vextraccions';

    public function extraccins()
    {
        return $this->hasMany(extraccion::class);
    }

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
