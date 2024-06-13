<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipos_extraccion extends Model
{

    protected $table = 'equipos_extraccion';

    public function equipos()
    {
        return $this->belongsTo(equipos::class);
    }
    
    use HasFactory;
}
