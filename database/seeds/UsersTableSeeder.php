<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Xpto Administrador',
            'email' => 'admin@finxi.com',
            'password' => Hash::make('admin123'),
            'role_id' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Xpto Anunciante',
            'email' => 'anunciante@finxi.com',
            'password' => Hash::make('admin123'),
            'role_id' => 2
        ]);
    }
}
