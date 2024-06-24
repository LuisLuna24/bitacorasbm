<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especies extends Model
{
    protected $table = 'especies';
    protected $fillable = [
        'nombre',
        'user_id'
    ];

    //relacion muchos a uno
    public function User(){
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos con vanalises
    public function vespecies(){
        return $this->hasMany(vespecies::class);
    }

    
    public function pcr()
    {
        return $this->belongsToMany(pcr::class);
    }

    public function pcrs_especies()
    {
        return $this->hasMany(pcrs_especies::class);
    }

    public function especies_vpcr(){
        return $this->hasMany(especies_vpcr::class);    
    }

    //relacion con vpcrs
    public function vpcrs(){
        return $this->belongsToMany(vpcrs::class);
    }

    public function vpcreals(){
        return $this->belongsToMany(vpcreals::class);
    }


    use HasFactory;
}
