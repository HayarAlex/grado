<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'description' => 'Admin'
        ]);
        Rol::create([
            'description' => 'Administrador'
        ]);
        Rol::create([
            'description' => 'Empleado'
        ]);
        Rol::create([
            'description' => 'Cliente'
        ]);
        Rol::create([
            'description' => 'Entrenador'
        ]);
    }
}
