<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivos_pcrs extends Model
{
    protected $table ='reactivos_pcrs';
    protected $fillable = [
       'reactivo_id',
        'pcr_id'
    ];


    //relacion con usuarios
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reactivos()
    {
        return $this->belongsTo(reactivos::class);
    }
    
    use HasFactory;
}
