<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nivel'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    //^==============================================Relacion con catalogos
    //&=====================================Analisis
    public function  analises(){
        return $this->hasMany(analises::class);
    }

    public function  vanalises(){
        return $this->hasMany(vanalises::class);
    }

    //&=====================================Metodos
    public function  metodos(){
        return $this->hasMany(metodos::class);
    }

    public function  vmetodos(){
        return $this->hasMany(vmetodos::class);
    }

    //&=====================================Especies
    public function  especies(){
        return $this->hasMany(especies::class);
    }

    public function  vespecies(){
        return $this->hasMany(vespecies::class);
    }

    //^==============================================Relacion con inventarios
    //&=====================================Equipos
    public function  equipos(){
        return $this->hasMany(equipos::class);
    }

    public function  vequipos(){
        return $this->hasMany(vequipos::class);
    }

    //&=====================================Reactivos
    public function  reactivos(){
        return $this->hasMany(reactivos::class);
    }

    public function  vreactivos(){
        return $this->hasMany(vreactivos::class);
    }

    //^==============================================Relacion con bitacoras
    //&=====================================Pcr
    public function pcrs(){
        return $this->hasMany(pcr::class);
    }

    public function vpcrs(){
        return $this->hasMany(vpcrs::class);
    }

    //&=====================================Pcreal
    public function pcreals(){
        return $this->hasMany(pcreal::class);
    }

    public function vpcreals(){
        return $this->hasMany(vpcreals::class);
    }

    //&=====================================Extraccion
    public function extraccion(){
        return $this->hasMany(extraccion::class);
    }

    public function vextraccion(){
        return $this->hasMany(vextraccion::class);
    }

    //&=====================================Reactivos pcr
    public function reactivopcrs(){
        return $this->hasMany(reactivopcrs::class);
    }

    public function vreactivopcrs(){
        return $this->hasMany(vreactivopcrs::class);
    }

    //&=====================================Reactivos pcreal
    public function reactivopcreals(){
        return $this->hasMany(reactivopcreals::class);
    }

    public function vreactivopcreals(){
        return $this->hasMany(vreactivopcrs::class);
    }


}
