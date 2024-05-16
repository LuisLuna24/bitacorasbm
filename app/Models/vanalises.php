<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vanalises extends Model
{
    protected $table = 'vanalises';

    protected $fillable = [
        'nombre'
    ];

    //muchos a uno
    public function analises(){
        return $this->hasMany(analises::class);
    }

    //usuario a anamises
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    use HasFactory;
}
