<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extraccion_vreactivoextraccions extends Model
{
     //^==============================================Datos de tabla

     protected $table = 'extraccion_vreactivoextraccions';

    
     //^==============================================Relacion bitacoras
     //&=====================================version reactivo pcr
     public function vreactivoextraccions()
     {
         return $this->belongsTo(vreactivoextraccions::class);
     }
 
     //&=====================================Pcr
     public function extraccion()
     {
         return $this->belongsTo(extraccion::class);
     }
    use HasFactory;
}
