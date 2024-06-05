<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vpcrs extends Model
{
    protected $table = 'vpcrs';

    protected $fillable = [
        'nombre'
    ];

    //muchos a uno

    public function pcrs()
    {
        return $this->hasMany(pcr::class);
    }

    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }
    use HasFactory;
}
