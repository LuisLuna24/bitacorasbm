<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extraccion_reactivos extends Model
{
    protected $table = 'extraccion_reactivos';
    protected $fillable = [
        'id_extraccion',
        'id_bit_reactivo',
    ];

    public function bit_reactivo(){
        return $this->belongsTo(bit_reactivos::class, 'id_bit_reactivo', 'id');
    }

    public function extraccion(){
        return $this->belongsTo(extraccion::class, 'id_extraccion', 'id');
    }
    use HasFactory;
}
