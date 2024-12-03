<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr_reactivos extends Model
{
    protected $table = 'pcr_reactivos';
    protected $fillable = ['id_pcr', 'id_bit_reactivo'];

    //bit reactivo
    public function bit_reactivo(){
        return $this->belongsTo(bit_reactivos::class, 'id_bit_reactivo');
    }

    //pcr
    public function pcr(){
        return $this->belongsTo(pcr::class, 'id_pcr');
    }
    use HasFactory;
}
