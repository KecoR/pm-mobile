<?php

use Illuminate\Database\Seeder;

class MatakuliahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matakuliah')->insert([
            'matkul' => 'Pemrograman Mobile',
        ]);

        DB::table('matakuliah')->insert([
            'matkul' => 'Pemrograman Web',
        ]);

        DB::table('matakuliah')->insert([
            'matkul' => 'Kriptografi',
        ]);

        DB::table('matakuliah')->insert([
            'matkul' => 'Pemrosesan Data Tersebar',
        ]);

        DB::table('matakuliah')->insert([
            'matkul' => 'Basis Data',
        ]);
    }
}
