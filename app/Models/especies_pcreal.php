<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especies_pcreal extends Model
{
    //^==============================================Datos de Tablas
    protected $table = 'especies_pcreal';

    //^==============================================Relacion con especies
    public function especies()
    {
        return $this->belongsTo(especies::class);
    }

    use HasFactory;
}
