<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vreactivos extends Model
{
    protected $table = 'vreactivos';
    protected $fillable = [
        'nombre',
    ];

    //muchos a uno
    public function reactivo(){
        return $this->belongsTo(reactivos::class);
    }

    //usuario a anamises
    public function user(){
        return $this->belongsTo(User::class);
    }


    use HasFactory;
}
