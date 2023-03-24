<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petugas')->insert([
            'nama_petugas' => 'Sara',
            'username' => 'sarasar',
            'password' => Hash::make('password'),
            'telp' => '089526380621',
            'level' => 'administrator',
            'status' => true,
            'created_at' => now()
        ]);

        DB::table('petugas')->insert([
            'nama_petugas' => 'petugas ',
            'username' => 'sarpet',
            'password' => Hash::make('password'),
            'telp' => '089526380621',
            'level' => 'petugas',
            'status' => true,
            'created_at' => now()
        ]);
    }
}
