<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'clave' => 'admin',
            'name' => 'Administrador',
            'description'=>'Administrador de la biblioteca',
        ]);
        DB::table('roles')->insert([
            'clave' => 'user',
            'name' => 'Usuario',
            'description'=>'usuario final de la biblioteca',
        ]);
    }
}
