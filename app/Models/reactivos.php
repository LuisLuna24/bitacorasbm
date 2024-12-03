<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivos extends Model
{
    protected $table = 'pcreal_reactivos';
    protected $fillable = ['id_pcreal', 'id_bit_reactivo'];

    //bit reactivo
    public function bit_reactivo(){
        return $this->belongsTo(bit_reactivos::class, 'id_bit_reactivo');
    }

    //pcreal
    public function pcreal(){
        return $this->belongsTo(pcreal::class, 'id_pcreal');
    }

    use HasFactory;
}
