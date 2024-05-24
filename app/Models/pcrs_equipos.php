<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcrs_equipos extends Model
{
    protected $table = 'equipos_pcr';

    public function equipos()
    {
        return $this->belongsTo(equipos::class);
    }
    use HasFactory;
}
