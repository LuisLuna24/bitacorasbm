<?php

namespace Database\Seeders;

use App\Models\tipo_usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposusuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo1 = new tipo_usuario();
        $tipo1->id = 1;
        $tipo1->tipo = "Administrador";
        $tipo1->estatus = 1;
        $tipo1->save();

        $tipo1 = new tipo_usuario();
        $tipo1->id = 2;
        $tipo1->tipo = "Empleado";
        $tipo1->estatus = 1;
        $tipo1->save();

        
    }
}
