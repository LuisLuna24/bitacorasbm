<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pcrs_reactivopcr extends Model
{
    protected $table = 'pcr_reactivopcr';

    public function pcr(){
        return $this->belongsTo(pcr::class);
    }

    
    use HasFactory;
}
