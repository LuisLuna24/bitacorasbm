<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vpcreals extends Model
{
    protected $table = 'vpcreals';

    public function pcreals()
    {
        return $this->hasMany(pcreal::class);
    }

    public function analisis()
    {
        return $this->belongsTo(analises::class);
    }

    use HasFactory;
}
