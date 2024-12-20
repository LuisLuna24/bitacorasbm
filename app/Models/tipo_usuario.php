<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_usuario extends Model
{
    protected $table = 'tipo_usuarios';
    protected $fillable = ['tipo','estatus'];
    use HasFactory;
}
