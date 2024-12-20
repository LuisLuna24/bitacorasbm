<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = new User();
        $user1->name = 'Administrador';
        $user1->email = 'lued1006@gmail.com';
        $user1->password = bcrypt('Hmcnjsa1*');
        $user1->tipo_usuario_id = 1;
        $user1->estatus = 1;
        $user1->email_verified_at = '05/08/2024';
        $user1->save();

        $user2 = new User();
        $user2->name = 'Empleado';
        $user2->email = 'lued1009@gmail.com';
        $user2->password = bcrypt('Hmcnjsa1*');
        $user2->tipo_usuario_id = 2;
        $user2->estatus = 1;
        $user2->email_verified_at = '05/08/2024';
        $user2->save();
    }
}
