<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivos extends Model
{
    protected $table = 'reactivos';
    protected $fillable = [
        'id',
        'lote',
        'nombre',
        'descripcion',
        'stock',
        'caducidad',
        'version',
        'estatus'
    ];

    //bit reactivo
    public function bit_reactivo()
    {
        return $this->belongsTo(bit_reactivos::class, 'id_bit_reactivo');
    }

    use HasFactory;
}
