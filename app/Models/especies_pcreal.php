<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especies_pcreal extends Model
{
    protected $table = 'especies_pcreal';

    public function especies()
    {
        return $this->belongsTo(especies::class);
    }

    use HasFactory;
}
