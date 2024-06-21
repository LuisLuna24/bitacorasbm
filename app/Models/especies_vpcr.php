<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especies_vpcr extends Model
{
    protected $table = 'especies_vpcrs';

    public function especies()
    {
        return $this->belongsTo(especies::class);
    }

    
    use HasFactory;
}
