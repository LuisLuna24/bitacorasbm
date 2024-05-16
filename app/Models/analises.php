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

    //relacion muchos a uno
    public function User(){
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos con vanalises
    public function vanalises(){
        return $this->hasMany(vanalises::class);
    }

    use HasFactory;
}
