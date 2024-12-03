<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{
    protected $table = 'empleados';
    protected $fillable = ['id', 'nombre', 'ap_materno', 'ap_paterno ', 'no_empleado' , 'id_usuario', 'estatus'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    use HasFactory;
}
