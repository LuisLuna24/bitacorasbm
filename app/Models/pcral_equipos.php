<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcral_equipos extends Model
{
    protected $table = 'pcral_equipos';
    protected $fillable = ['id', 'id_pcreal', 'id_equipo'];

    //pcral
    public function pcreal(){
        return $this->belongsTo(pcreal::class, 'id_pcreal', 'id');
    }

    //equipo
    public function equipo(){
        return $this->belongsTo(equipos::class, 'id_equipo', 'id');
    }
    use HasFactory;
}
