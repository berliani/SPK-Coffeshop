<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Objek;
use App\Models\Penilaian;
use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            "name" => "Admin",
            "email" => "Admin@gmail.com",
            "password" => Hash::make("Admin123"),
        ]);

        $kode = ["C1", "C2", "C3", "C4", "C5"];
        $namaKriteria = ["Fasilitas", "Harga", "Lokasi", "Variasi Menu", "Jam Operasional"];
        $bobot = [4, 5, 3, 3, 3];
        $tipe = ["benefit", "cost", "benefit", "benefit", "benefit"];

        // Definisikan SubKriteria dan Nilai
        $subKriteria = [
            "Fasilitas" => [
                ["nama" => "Kurang Lengkap (1-3 Fasilitas)", "nilai" => 3],
                ["nama" => "Lengkap (4-6 Fasilitas)", "nilai" => 4],
                ["nama" => "Sangat Lengkap (7-10 Fasilitas)", "nilai" => 5],
            ],
            "Harga" => [
                ["nama" => "Mahal (41.000-100.000)", "nilai" => 1],
                ["nama" => "Standar Normal (31.000-40.000)", "nilai" => 3],
                ["nama" => "Murah (10.000-30.000)", "nilai" => 5],
            ],
            "Lokasi" => [
                ["nama" => "Pusat Kota (Kota Tegal)", "nilai" => 1],
                ["nama" => "Pinggir Kota (Kab. Tegal)", "nilai" => 4],
            ],
            "Variasi Menu" => [
                ["nama" => "Sedikit (15-30 MENU)", "nilai" => 3],
                ["nama" => "Cukup (31-50 MENU)", "nilai" => 4],
                ["nama" => "Banyak (51-100 MENU)", "nilai" => 5],
            ],
            "Jam Operasional" => [
                ["nama" => "24 JAM", "nilai" => 5],
                ["nama" => "PAGI-MALAM", "nilai" => 4],
                ["nama" => "SIANG-MALAM", "nilai" => 3],
            ]
        ];

        // Menambahkan Kriteria ke database
        for ($i = 0; $i < 5; $i++) {
            Kriteria::create([
                "kode" => $kode[$i],
                "nama" => $namaKriteria[$i],
                "bobot" => $bobot[$i],
                "tipe" => $tipe[$i], // Menambahkan tipe
            ]);
        }

        // Menambahkan SubKriteria ke database
        foreach ($subKriteria as $kriteriaNama => $subs) {
            $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
            foreach ($subs as $index => $sub) {
                SubKriteria::create([
                    "kode" => $kriteria->kode . ($index + 1),
                    "nama" => $sub['nama'],
                    "nilai" => $sub['nilai'],
                    "kriteria_id" => $kriteria->id,
                ]);
            }
        }

        $namaObjek = ["Sungai Space", "Svara Coffee", "Wiji Kopi", "Claviculla", "Njajan.co Tegal"];
        $alamatObjek = ["Pintu air, Kalimiring, Yamansari, Kec. Lebaksiu, Kabupaten Tegal",
        "Jl. KS. Tubun No.71, Debong Tengah, Kec. Tegal Sel., Kota Tegal",
         "Jl. Werkudoro No.74, Slerok, Kec. Tegal Tim., Kota Tegal",
         "Jalan DR. Soetomo no.3 RT 004 RT 006.ds.Kalisapu, Kalisapu, Tengah, Griya Prajamukti, Jawa, Kec. Slawi, Kabupaten Tegal",
          "Jl. Sumbing No.18, Panggung, Kec. Tegal Tim., Kota Tegal"];

        for ($i = 0; $i < 5; $i++) {
            Objek::create([
                "nama" => $namaObjek[$i],
                "alamat" => $alamatObjek[$i], // Menambahkan alamat
            ]);
        }

        for ($i = 0; $i < 4; $i++) {
            Alternatif::create([
                "objek_id" => $i + 1,
            ]);
        }

        $penilaian = [
            [4, 3, 3, 4, 4], // Sesuaikan penilaian dengan sub-kriteria yang ada
            [4, 3, 4, 4, 4],
            [3, 3, 4, 3, 3],
            [4, 3, 3, 4, 4],
            [5, 3, 4, 5, 5],
        ];

        for ($j = 0; $j < 4; $j++) {
            for ($i = 0; $i < 4; $i++) {
                $kriteria = Kriteria::find($i + 1);
                $sub_kriteria_id = SubKriteria::where('kriteria_id', $kriteria->id)
                                              ->where('nilai', $penilaian[$j][$i])
                                              ->first('id')
                                              ->id;

                Penilaian::create([
                    "alternatif_id" => $j + 1,
                    "kriteria_id" => $kriteria->id,
                    "sub_kriteria_id" => $sub_kriteria_id,
                ]);
            }
        }
    }
}
