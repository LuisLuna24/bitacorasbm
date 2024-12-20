<?php

namespace Database\Seeders;

use App\Models\rutas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogo = new rutas();
        $catalogo->nombre = "Especies";
        $catalogo->route = "admin.catalogos.especies";
        $catalogo->estatus = 1;
        $catalogo->tipo_usuario = 1;
        $catalogo->tipo_ruta = 1;
        $catalogo->save();

        $catalogo2 = new rutas();
        $catalogo2->nombre = "Analisis";
        $catalogo2->route = "admin.catalogos.analisis";
        $catalogo2->estatus = 1;
        $catalogo2->tipo_usuario = 1;
        $catalogo2->tipo_ruta = 1;
        $catalogo2->save();

        $catalogo3 = new rutas();
        $catalogo3->nombre = "Metodos";
        $catalogo3->route = "admin.catalogos.metodos";
        $catalogo3->estatus = 1;
        $catalogo3->tipo_usuario = 1;
        $catalogo3->tipo_ruta = 1;
        $catalogo3->save();
    }
}
