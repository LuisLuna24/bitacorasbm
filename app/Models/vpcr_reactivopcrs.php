<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vpcr_reactivopcrs extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'vpcr_reactivopcrs';

    //^==============================================Relacion bitacoras
    //&=====================================Vercion Pcr
    public function vpcr()
    {
        return $this->belongsTo(vpcrs::class);
    }

    //&=====================================version reactivo pcr
    public function vreactivopcrs()
    {
        return $this->belongsTo(vreactivopcrs::class);
    }

    use HasFactory;
}
