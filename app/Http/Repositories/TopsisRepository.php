<?php

namespace App\Http\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TopsisRepository
{
    // Matriks Keputusan
    public function getMatriksKeputusan()
    {
        $data = DB::table('matriks_keputusan as mp')
            ->join('kriteria as k', 'k.id', 'mp.kriteria_id')
            ->select('mp.*', 'k.nama as nama_kriteria')
            ->orderBy('mp.id', 'asc')->get();

        return $data;
    }
    public function getMatriksKeputusanKriteria($kriteria_id)
    {
        $data = DB::table('matriks_keputusan')->where('kriteria_id', $kriteria_id)->first();
        return $data;
    }
    public function addMatriksKeputusan($data)
    {
        DB::table('matriks_keputusan')->insert([
            'nilai' => $data['nilai'],
            'kriteria_id' => $data['kriteria_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    public function updateMatriksKeputusan($data)
    {
        DB::table('matriks_keputusan')->where('kriteria_id', $data['kriteria_id'])->update([
            'nilai' => $data['nilai'],
            'updated_at' => Carbon::now(),
        ]);
    }

    // Matriks Normalisasi
    public function getMatriksNormalisasi()
    {
        $data = DB::table('matriks_normalisasi_keputusan as mnk')
            ->join('kriteria as k', 'k.id', 'mnk.kriteria_id')
            ->join('alternatif as a', 'a.id', 'mnk.alternatif_id')
            ->join('objek as o', 'o.id', 'a.objek_id')
            ->select('mnk.*', 'k.nama as nama_kriteria', 'o.nama as nama_objek')
            ->orderBy('mnk.id', 'asc')->get();

        return $data;
    }
    public function getMatriksNormalisasiKriteriaAlternatif($kriteria_id, $alternatif_id)
    {
        $data = DB::table('matriks_normalisasi_keputusan')->where('kriteria_id', $kriteria_id)->where('alternatif_id', $alternatif_id)->first();
        return $data;
    }
    public function addMatriksNormalisasi($data)
    {
        DB::table('matriks_normalisasi_keputusan')->insert([
            'nilai' => $data['nilai'],
            'alternatif_id' => $data['alternatif_id'],
            'kriteria_id' => $data['kriteria_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    public function updateMatriksNormalisasi($data)
    {
        DB::table('matriks_normalisasi_keputusan')->where('kriteria_id', $data['kriteria_id'])->where('alternatif_id', $data['alternatif_id'])->update([
            'nilai' => $data['nilai'],
            'updated_at' => Carbon::now(),
        ]);
    }

    // Matriks Y
    public function getMatriksY()
    {
        $data = DB::table('matriks_normalisasi_bobot_keputusan as mnbk')
            ->join('kriteria as k', 'k.id', 'mnbk.kriteria_id')
            ->join('alternatif as a', 'a.id', 'mnbk.alternatif_id')
            ->join('objek as o', 'o.id', 'a.objek_id')
            ->select('mnbk.*', 'k.nama as nama_kriteria', 'o.nama as nama_objek')
            ->orderBy('mnbk.id', 'asc')->get();

        return $data;
    }
    public function getMatriksYKriteriaAlternatif($kriteria_id, $alternatif_id)
    {
        $data = DB::table('matriks_normalisasi_bobot_keputusan')->where('kriteria_id', $kriteria_id)->where('alternatif_id', $alternatif_id)->first();
        return $data;
    }
    public function getMatriksYKriteria($kriteria_id)
    {
        $data = DB::table('matriks_normalisasi_bobot_keputusan')->where('kriteria_id', $kriteria_id)->first();
        return $data;
    }
    public function addMatriksY($data)
    {
        DB::table('matriks_normalisasi_bobot_keputusan')->insert([
            'nilai' => $data['nilai'],
            'alternatif_id' => $data['alternatif_id'],
            'kriteria_id' => $data['kriteria_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    public function updateMatriksY($data)
    {
        DB::table('matriks_normalisasi_bobot_keputusan')->where('kriteria_id', $data['kriteria_id'])->where('alternatif_id', $data['alternatif_id'])->update([
            'nilai' => $data['nilai'],
            'updated_at' => Carbon::now(),
        ]);
    }

    // Ideal
    public function getIdealPositif()
    {
        $data = DB::table('idealpositif as ip')
            ->join('kriteria as k', 'k.id', 'ip.kriteria_id')
            ->select('ip.*', 'k.nama as nama_kriteria')
            ->orderBy('ip.id', 'asc')->get();

        return $data;
    }

    public function getIdealPositifKriteria($kriteria_id)
    {
        $data = DB::table('idealpositif')
            ->where('kriteria_id', $kriteria_id)
            ->first();

        return $data;
    }

    public function addIdealPositif($data)
    {
        DB::table('idealpositif')->insert([
            'kriteria_id' => $data['kriteria_id'],
            'nilai' => $data['nilai'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function updateIdealPositif($data)
    {
        DB::table('idealpositif')
            ->where('kriteria_id', $data['kriteria_id'])
            ->update([
                'nilai' => $data['nilai'],
                // 'updated_at' => Carbon::now(),
            ]);


         } public function getIdealNegatif()
            {
                $data = DB::table('idealnegatif as ip')
                    ->join('kriteria as k', 'k.id', 'ip.kriteria_id')
                    ->select('ip.*', 'k.nama as nama_kriteria')
                    ->orderBy('ip.id', 'asc')->get();

                return $data;
            }

            public function getIdealNegatifKriteria($kriteria_id)
            {
                $data = DB::table('idealnegatif')
                    ->where('kriteria_id', $kriteria_id)
                    ->first();

                return $data;
            }

            public function addIdealNegatif($data)
            {
                DB::table('idealnegatif')->insert([
                    'kriteria_id' => $data['kriteria_id'],
                    'nilai' => $data['nilai'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            public function updateIdealNegatif($data)
            {
                DB::table('idealnegatif')
                    ->where('kriteria_id', $data['kriteria_id'])
                    ->update([
                        'nilai' => $data['nilai'],
                        // 'updated_at' => Carbon::now(),
                    ]);

    // Solusi Ideal
  }public function getSolusiIdealPositif()
    {
        $data = DB::table('solusi_ideal_positif as sip')
            ->join('alternatif as a', 'a.id', 'sip.alternatif_id')
            ->join('objek as o', 'o.id', 'a.objek_id')
            ->select('sip.*', 'o.nama as nama_objek')
            ->orderBy('sip.id', 'asc')->get();

        return $data;
    }
    public function getSolusiIdealPositifKriteria($alternatif_id)
    {
        $data = DB::table('solusi_ideal_positif')->where('alternatif_id', $alternatif_id)->first();
        return $data;
    }
    public function addSolusiIdealPositif($data)
    {
        DB::table('solusi_ideal_positif')->insert([
            'nilai' => $data['nilai'],
            'alternatif_id' => $data['alternatif_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    public function updateSolusiIdealPositif($data)
    {
        DB::table('solusi_ideal_positif')->where('alternatif_id', $data['alternatif_id'])->update([
            'nilai' => $data['nilai'],
            'updated_at' => Carbon::now(),
        ]);
    }
    public function getSolusiIdealNegatif()
    {
        $data = DB::table('solusi_ideal_negatif as sin')
            ->join('alternatif as a', 'a.id', 'sin.alternatif_id')
            ->join('objek as o', 'o.id', 'a.objek_id')
            ->select('sin.*', 'o.nama as nama_objek')
            ->orderBy('sin.id', 'asc')->get();

        return $data;
    }
    public function getSolusiIdealNegatifKriteria($alternatif_id)
    {
        $data = DB::table('solusi_ideal_negatif')->where('alternatif_id', $alternatif_id)->first();
        return $data;
    }
    public function addSolusiIdealNegatif($data)
    {
        DB::table('solusi_ideal_negatif')->insert([
            'nilai' => $data['nilai'],
            'alternatif_id' => $data['alternatif_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    public function updateSolusiIdealNegatif($data)
    {
        DB::table('solusi_ideal_negatif')->where('alternatif_id', $data['alternatif_id'])->update([
            'nilai' => $data['nilai'],
            'updated_at' => Carbon::now(),
        ]);
    }

    // Hasil Topsis
    public function getHasilTopsis()
    {
        $data = DB::table('hasil_solusi_topsis as hst')
            ->join('alternatif as a', 'a.id', 'hst.alternatif_id')
            ->join('objek as o', 'o.id', 'a.objek_id')
            ->select('hst.*', 'o.nama as nama_objek')
            ->orderBy('hst.id', 'asc')->get();

        return $data;
    }
    public function getHasilTopsisAlternatif($alternatif_id)
    {
        $data = DB::table('hasil_solusi_topsis')->where('alternatif_id', $alternatif_id)->first();
        return $data;
    }
    public function addHasilTopsis($data)
    {
        DB::table('hasil_solusi_topsis')->insert([
            'nilai' => $data['nilai'],
            'alternatif_id' => $data['alternatif_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    public function updateHasilTopsis($data)
    {
        DB::table('hasil_solusi_topsis')->where('alternatif_id', $data['alternatif_id'])->update([
            'nilai' => $data['nilai'],
            'updated_at' => Carbon::now(),
        ]);
    }
}


