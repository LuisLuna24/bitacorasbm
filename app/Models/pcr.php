<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr extends Model
{
    protected $table = 'pcrs';

    protected $fillable = [
        'nombre'
    ];

    //relacion muchos a muchos con equipos
    public function equipos()
    {
        return $this->belongsToMany(equipos::class);
    }

    public function especies()
    {
        return $this->belongsToMany(especies::class);
    }

    //uno a uno
    
    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }

    //relacion con usuarios
    public function user(){
        return $this->belongsTo(User::class);
    }


    use HasFactory;
}
