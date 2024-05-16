<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vespecies extends Model
{
    protected $table = 'vespecies';

    protected $fillable = [
        'nombre'
    ];

    //muchos a uno
    public function especies(){
        return $this->hasMany(especies::class);
    }

    //usuario a anamises
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
