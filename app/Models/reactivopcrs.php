<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivopcrs extends Model
{
    protected $table ='reactivopcrs';

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
