<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodos extends Model
{

    protected $table = 'metodos';
    protected $fillable = ['nombre', 'version', 'estatus'];


    public function extraccion(){
        return $this->belongsTo(extraccion::class, 'id_metodo', 'id');
    }

    use HasFactory;
}
