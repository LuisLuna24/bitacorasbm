<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especies extends Model
{
    protected $table = 'especies';
    protected $fillable = ['nombre', 'version', 'estatus'];

    //pcr
    public function pcr(){
        return $this->belongsTo(pcr::class, 'id_especie', 'id');
    }

    public function pcreal(){
        return $this->belongsTo(pcreal::class, 'id_especie', 'id');
    }

    use HasFactory;
    
}
