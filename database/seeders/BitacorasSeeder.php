<?php

namespace Database\Seeders;

use App\Models\rutas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BitacorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bitacora1 = new rutas();
        $bitacora1->nombre = "PCR";
        $bitacora1->route = "admin.bitacoras.pcr";
        $bitacora1->estatus = 1;
        $bitacora1->tipo_usuario = 1;
        $bitacora1->tipo_ruta = 4;
        $bitacora1->save();

        $bitacora1 = new rutas();
        $bitacora1->nombre = "PCR Tiempo Real";
        $bitacora1->route = "admin.bitacoras.pcreal";
        $bitacora1->estatus = 1;
        $bitacora1->tipo_usuario = 1;
        $bitacora1->tipo_ruta = 4;
        $bitacora1->save();

        $bitacora1 = new rutas();
        $bitacora1->nombre = "Extraccion";
        $bitacora1->route = "admin.bitacoras.extraccion";
        $bitacora1->estatus = 1;
        $bitacora1->tipo_usuario = 1;
        $bitacora1->tipo_ruta = 4;
        $bitacora1->save();

        $bitacora1 = new rutas();
        $bitacora1->nombre = "Bitacora de reactivos";
        $bitacora1->route = "admin.bitacoras.bit_reactivo";
        $bitacora1->estatus = 1;
        $bitacora1->tipo_usuario = 1;
        $bitacora1->tipo_ruta = 4;
        $bitacora1->save();
    }

}
