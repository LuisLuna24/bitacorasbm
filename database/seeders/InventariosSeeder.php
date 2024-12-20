<?php

namespace Database\Seeders;

use App\Models\rutas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogo = new rutas();
        $catalogo->nombre = "Reactivos";
        $catalogo->route = "admin.inventarios.reactivos";
        $catalogo->estatus = 1;
        $catalogo->tipo_usuario = 1;
        $catalogo->tipo_ruta = 2;
        $catalogo->save();

        $catalogo = new rutas();
        $catalogo->nombre = "Equipos";
        $catalogo->route = "admin.inventarios.equipos";
        $catalogo->estatus = 1;
        $catalogo->tipo_usuario = 1;
        $catalogo->tipo_ruta = 2;
        $catalogo->save();
    }
}
