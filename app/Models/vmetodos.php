<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vmetodos extends Model
{
    protected $table = 'vmetodos';

    protected $fillable = [
        'nombre'
    ];

    //muchos a uno
    public function metodos(){
        return $this->hasMany(metodos::class);
    }

    //usuario a anamises
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
