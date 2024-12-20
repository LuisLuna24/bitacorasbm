<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bit_reactivos extends Model
{
    protected $table = 'bit_reactivos';
    protected $fillable = ['id', 'id_usuario', 'id_reactivo', 'no_registro', 'apertura', 'version', 'estatus'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function reactivo()
    {
        return $this->belongsTo(reactivos::class, 'id_reactivo', 'id');
    }
    
    use HasFactory;
}
