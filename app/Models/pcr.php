<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcr extends Model
{
    protected $table = 'pcrs';

    protected $fillable = [
        'no_registro', 
        'analisis_id', 
        'fecha', 
        'resultado', 
        'agarosa', 
        'voltaje', 
        'tiempo', 
        'sanitizo', 
        'tiempouv',
        'user_id',
        'validacion'
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

    public function rpcrs()
    {
        return $this->belongsToMany(reactivopcrs::class);
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

    public function vpcrs(){
        return $this->hasMany(vpcrs::class);
    }
    
    use HasFactory;
}
