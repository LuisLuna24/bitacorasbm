<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivos extends Model
{
    protected $table ='reactivos';
    protected $fillable = [
        'nombre',
        'description',
        'lote',
        'existencia',
        'fecha_caducidad',
        'user_id'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }


    public function reactivopcr()
    {
        return $this->belongsToMany(reactivopcrs::class);
    }

    public function vreactivopcrs()
    {
        return $this->belongsToMany(vreactivopcrs::class);
    }

    //relacion de uno a muchos con vanalises
    public function vreactivos(){
        return $this->hasMany(vreactivos::class);
    }
    use HasFactory;

    
}
