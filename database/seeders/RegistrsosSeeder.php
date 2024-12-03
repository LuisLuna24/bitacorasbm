<?php

namespace Database\Seeders;

use App\Models\rutas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrsosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogo = new rutas();
        $catalogo->nombre = "Empleados";
        $catalogo->route = "admin.registros.empleados";
        $catalogo->estatus = 1;
        $catalogo->tipo_usuario = 1;
        $catalogo->tipo_ruta = 3;
        $catalogo->save();
    }
}
