<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vreactivopcrs extends Model
{
    protected $table = 'vreactivopcrs';

    protected $fillable = [
        'reactivo_id', 'fecha_apertura','user_id','validacion','reactivopcrs_id','version'
     ];
 
     public function reactivo()
     {
         return $this->belongsTo(reactivos::class);
     }
 
     public function pcrs()
     {
         return $this->belongsToMany(pcr::class);
     }
 
     public function user(){
         return $this->belongsTo(User::class);
     }
 
    use HasFactory;
}
