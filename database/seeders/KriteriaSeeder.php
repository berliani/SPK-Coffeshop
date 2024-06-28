<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriteria = [
            ['kode' => 'C1', 'nama' => 'Fasilitas', 'bobot' => 4, 'tipe' => 'benefit'],
            ['kode' => 'C2','nama' => 'Harga', 'bobot' => 5, 'tipe' => 'cost'],
            ['kode' => 'C3','nama' => 'Lokasi', 'bobot' => 3, 'tipe' => 'benefit'],
            ['kode' => 'C4','nama' => 'Variasi Menu', 'bobot' => 3, 'tipe' => 'benefit'],
            ['kode' => 'C5','nama' => 'Jam Operasional', 'bobot' => 3, 'tipe' => 'benefit']
        ];

        foreach ($kriteria as $kriterias) {
            DB::table('kriteria')->insert([
                'kode' => $kriteria['kode'],
                'nama' => $kriteria['nama'],
                'bobot' => $kriteria['bobot'],
                'tipe' => $kriteria['tipe'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
