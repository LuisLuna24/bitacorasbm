<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr_equipos extends Model
{
    protected $table = 'pcr_equipos';
    protected $fillable = ['id_pcr', 'id_equipo'];

    //equipos
    public function equipo(){
        return $this->belongsTo(equipos::class, 'id_equipo');
    }

    //pcr
    public function pcr(){
        return $this->belongsTo(pcr::class, 'id_pcr');
    }

    use HasFactory;
}
