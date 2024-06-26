<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vespecies extends Model
{
    //^==============================================Datos de tabla

    protected $table = 'vespecies';
    protected $fillable = [
        'nombre',
        'user_id',
        'version',
        'especie_id'
    ];

    //^==============================================Relacion con usuarios

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //^==============================================Relacion con especies

    public function especies()
    {
        return $this->belongsTo(especies::class);
    }

    use HasFactory;
}
