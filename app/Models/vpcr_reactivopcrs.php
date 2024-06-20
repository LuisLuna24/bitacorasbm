<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vpcr_reactivopcrs extends Model
{
    protected $table = 'vpcr_reactivopcrs';

    public function pcr(){
        return $this->belongsTo(pcr::class);
    }

    public function vreactivopcrs(){
        return $this->belongsTo(vreactivopcrs::class);
    }
    use HasFactory;
}
