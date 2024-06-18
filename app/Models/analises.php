<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class analises extends Model
{
    protected $table = 'analises';
    protected $fillable = [
        'nombre',
        'user_id'
    ];

    //Relacion con usuarios 
    public function User(){
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos con vanalises
    public function vanalises(){
        return $this->hasMany(vanalises::class);
    }

    //un analisis puede estar en varios Pcr
    public function pcr()
    {
        return $this->hasMany(pcr::class);
    }

    public function vpcr()
    {
        return $this->hasMany(vpcrs::class);
    }

    //un analisis puede estar en varios Pcreal

    public function pcreal()
    {
        return $this->hasMany(pcreal::class);
    }

    public function vpcreal()
    {
        return $this->hasMany(vpcreals::class);
    }

    //un analisis puede estar en varios extracciones

    public function extraccion()
    {
        return $this->hasMany(extraccion::class);
    }

    public function vextraccion()
    {
        return $this->hasMany(vextraccion::class);
    }

    //un analisis puede estar en varios Pcreal

    public function reactivos_pcr()
    {
        return $this->hasMany(reactivos_pcrs::class);
    }

    use HasFactory;
}
