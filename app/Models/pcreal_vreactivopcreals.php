<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcreal_vreactivopcreals extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'pcreal_vreactivopcreals';

    
    //^==============================================Relacion bitacoras
    //&=====================================version reactivo pcr
    public function vreactivopcreals()
    {
        return $this->belongsTo(vreactivopcreals::class);
    }

    //&=====================================Pcr
    public function pcreal()
    {
        return $this->belongsTo(pcreal::class);
    }

    use HasFactory;
}
