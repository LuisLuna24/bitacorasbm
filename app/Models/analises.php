<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class analises extends Model
{
    protected $table = 'analises';
    protected $fillable = ['nombre', 'version', 'estatus'];

    //pcr
    public function pcr(){
        return $this->belongsTo(pcr::class, 'id_analisis');
    }

    public function pcreal(){
        return $this->belongsTo(pcreal::class, 'id_analisis');
    }

    public function extraccion(){
        return $this->belongsTo(extraccion::class, 'id_analisis');
    }

    use HasFactory;
}
