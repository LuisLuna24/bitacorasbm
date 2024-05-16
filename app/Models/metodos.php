<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodos extends Model
{
    protected $table ='metodos';

    protected $fillable = [
        'nombre',
        'user_id'
    ];

    //relacion muchos a uno
    public function User(){
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos con vanalises
    public function vmetodos(){
        return $this->hasMany(vmetodos::class);
    }

    use HasFactory;
}
