<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especies_vpcreals extends Model
{
    //^==============================================Datos de Tablas
    protected $table = 'especies_vpcreals';

    //^==============================================Datos de Tablas
    public function especies()
    {
        return $this->belongsTo(especies::class);
    }
    use HasFactory;
}
