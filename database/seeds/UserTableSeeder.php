<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'lucky',
            'full_name' => 'Lucky Anugrah',
            'password' => Hash::make('123456'),
            'role' => 'DOSEN',
        ]);

        DB::table('users')->insert([
            'username' => 'ariel',
            'full_name' => 'Ariel Terence',
            'password' => Hash::make('123456'),
            'role' => 'DOSEN',
        ]);

        DB::table('users')->insert([
            'username' => '201581111',
            'full_name' => 'Lucky Anugrah',
            'password' => Hash::make('123456'),
            'role' => 'MAHASISWA',
        ]);

        DB::table('users')->insert([
            'username' => '201581021',
            'full_name' => 'Ariel Terence',
            'password' => Hash::make('123456'),
            'role' => 'MAHASISWA',
        ]);
    }
}
