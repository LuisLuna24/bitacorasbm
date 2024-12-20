<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr_validacions extends Model
{

    protected $table = 'pcr_validacions';
    protected $fillable = [
        'id_pcr',
        'validacion',
        'observaciones',
    ];

    //pcr
    public function pcr(){
        return $this->belongsTo(pcr::class, 'id_pcr');
    }

    use HasFactory;

}
