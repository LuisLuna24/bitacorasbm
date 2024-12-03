<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcral_especies extends Model
{
    protected $table = 'pcreal_especies';
    protected $fillable = ['id_pcreal', 'id_especie', 'resultado'];

    //especies
    public function especies(){
        return $this->belongsTo(especies::class, 'id_especie');
    }

    //pcreal
    public function pcreal(){
        return $this->belongsTo(pcreal::class, 'id_pcreal');
    }

    use HasFactory;
}
