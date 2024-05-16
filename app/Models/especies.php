<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especies extends Model
{
    protected $table = 'especies';
    protected $fillable = [
        'nombre',
        'user_id'
    ];

    //relacion muchos a uno
    public function User(){
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos con vanalises
    public function vespecies(){
        return $this->hasMany(vespecies::class);
    }
    use HasFactory;
}
