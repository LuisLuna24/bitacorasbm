<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(CatalogosSeeder::class);
        $this->call(TiposusuariosSeeder::class);
        $this->call(InventariosSeeder::class);
        $this->call(BitacorasSeeder::class);
        $this->call(RegistrsosSeeder::class);
        $this->call(UsuariosSeeder::class);
    }
}
