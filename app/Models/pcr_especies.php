<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr_especies extends Model
{
    protected $table = 'pcr_especies';
    protected $fillable = ['id_pcr', 'id_especie', 'resultado'];

    //especies
    public function especies(){
        return $this->belongsTo(especies::class, 'id_especie');
    }

    //pcr
    public function pcr(){
        return $this->belongsTo(pcr::class, 'id_pcr');
    }

    use HasFactory;
}
