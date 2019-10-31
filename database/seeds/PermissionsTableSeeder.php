<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'description' => 'Crear',
        ]);
        DB::table('permissions')->insert([
            'description' => 'Leer',
        ]);
        DB::table('permissions')->insert([
            'description' => 'Actualizar',
        ]);
        DB::table('permissions')->insert([
            'description' => 'Eliminar',
        ]);
        DB::table('permissions')->insert([
            'description' => 'Copiar',
        ]);
        DB::table('permissions')->insert([
            'description' => 'Activar',
        ]);
    }
}
