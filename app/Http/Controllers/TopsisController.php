<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use App\Http\Services\TopsisService;
use App\Http\Services\KriteriaService;
use App\Http\Services\PenilaianService;
use Illuminate\Http\Request;
use App\Models\Alternatif;

class TopsisController extends Controller
{
    protected $topsisServices, $penilaianService, $kriteriaService;

    public function __construct(TopsisService $topsisServices, PenilaianService $penilaianService, KriteriaService $kriteriaService)
    {
        $this->topsisServices = $topsisServices;
        $this->penilaianService = $penilaianService;
        $this->kriteriaService = $kriteriaService;
    }

    public function hasilAkhir()
    {
        $judul = "Hasil Akhir";
        $hasilTopsis = $this->topsisServices->getHasilTopsis();

        return view('admin.dashboard.hasil_akhir.index', [
            'judul' => $judul,
            'hasilTopsis' => $hasilTopsis,
        ]);
    }

    public function index()
    {
        $judul = "Perhitungan";

        $kriteria = $this->kriteriaService->getAll();
        $penilaian = $this->penilaianService->getAll();
        $matriksKeputusan = $this->topsisServices->getMatriksKeputusan();
        $matriksNormalisasi = $this->topsisServices->getMatriksNormalisasi();
        $matriksY = $this->topsisServices->getMatriksY();
        $solusiIdealPositif = $this->topsisServices->getSolusiIdealPositif();
        $solusiIdealNegatif = $this->topsisServices->getSolusiIdealNegatif();
        $idealPositif = $this->topsisServices->getIdealPositif();
        $idealNegatif = $this->topsisServices->getIdealNegatif();
        $hasilTopsis = $this->topsisServices->getHasilTopsis();

        return view('admin.dashboard.perhitungan.index', [
            'judul' => $judul,
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'matriksKeputusan' => $matriksKeputusan,
            'matriksNormalisasi' => $matriksNormalisasi,
            'matriksY' => $matriksY,
            'idealPositif' => $idealPositif,
            'idealNegatif' => $idealNegatif,
            'solusiIdealPositif' => $solusiIdealPositif,
            'solusiIdealNegatif' => $solusiIdealNegatif,
            'hasilTopsis' => $hasilTopsis,
        ]);
    }

    public function hitungTopsis()
    {
        $this->hitungMatriksKeputusan();
        $this->hitungMatriksNormalisasi();
        $this->hitungMatriksY();
        $this->hitungIdeal();
        $this->hitungSolusiIdeal();
        $this->hitungHasil();
        return redirect('dashboard/perhitungan')->with('berhasil', "Perhitungan TOPSIS Selesai!");
    }

    public function hitungTopsisSetelahHapus()
    {
        $this->hitungMatriksKeputusan();
        $this->hitungMatriksNormalisasi();
        $this->hitungMatriksY();
        $this->hitungIdeal();
        $this->hitungSolusiIdeal();
        $this->hitungHasil();
    }

    public function hitungMatriksKeputusan() //matriks pembagi
    {
        $penilaian = $this->penilaianService->getAll();
        foreach ($penilaian->unique('kriteria_id') as $item) {
            $penilaianKriteria = $penilaian->where('kriteria_id', $item->kriteria_id);
            $hitungMatriks = 0;

            foreach ($penilaianKriteria as $value) {
                if ($value->sub_kriteria_id == null) {
                    abort(403, "Masukkan nilai alternatif ". $value->alternatif->objek->nama ."!");
                }
                $hitungMatriks += pow($value->subKriteria->nilai, 2);
            }

            $hitungMatriks = sqrt($hitungMatriks);
            $data = [
                'kriteria_id' => $item->kriteria_id,
                'nilai' => $hitungMatriks,
            ];

            $this->topsisServices->simpanMatriksKeputusan($data);
        }
    }

    public function hitungMatriksNormalisasi()
    {
        $penilaian = $this->penilaianService->getAll();
        foreach ($penilaian->unique('kriteria_id') as $item) {
            $penilaianKriteria = $penilaian->where('kriteria_id', $item->kriteria_id);
            $matriksKeputusan = $this->topsisServices->getMatriksKeputusanKriteria($item->kriteria_id);

            foreach ($penilaianKriteria as $value) {
                $matriksNormalisasi = $value->subKriteria->nilai / $matriksKeputusan->nilai;
                $data = [
                    'nilai' => $matriksNormalisasi,
                    'kriteria_id' => $value->kriteria_id,
                    'alternatif_id' => $value->alternatif_id,
                ];
                $this->topsisServices->simpanMatriksNormalisasi($data);
            }
        }
    }

    public function hitungMatriksY()
    {
        $matriksNormalisasi = $this->topsisServices->getMatriksNormalisasi();
        foreach ($matriksNormalisasi->unique('kriteria_id') as $item) {
            $matriksNormalisasiKriteria = $matriksNormalisasi->where('kriteria_id', $item->kriteria_id);
            $bobotKriteria = $this->kriteriaService->getDataById($item->kriteria_id);

            foreach ($matriksNormalisasiKriteria as $value) {
                $matriksY = $value->nilai * $bobotKriteria->bobot;
                $data = [
                    'nilai' => $matriksY,
                    'kriteria_id' => $value->kriteria_id,
                    'alternatif_id' => $value->alternatif_id,
                ];
                $this->topsisServices->simpanMatriksY($data);
            }
        }
    }

    public function hitungIdeal() // A+ dan A-
    {
        $Ideal = $this->topsisServices->getMatriksY();
        foreach ($Ideal->unique('kriteria_id') as $item) {
            $IdealKriteria = $Ideal->where('kriteria_id', $item->kriteria_id);

            // Ambil jenis kriteria (benefit atau cost)
            $kriteria = $this->kriteriaService->getDataById($item->kriteria_id);

            // Tentukan solusi ideal positif dan negatif berdasarkan jenis kriteria
            $IdealPositif = null;
            $IdealNegatif = null;

            if ($kriteria->jenis == 'benefit') {
                // Untuk kriteria benefit
                $IdealPositif = $IdealKriteria->max('nilai');
                $IdealNegatif = $IdealKriteria->min('nilai');
            } elseif ($kriteria->jenis == 'cost') {
                // Untuk kriteria cost
                $IdealPositif = $IdealKriteria->min('nilai');
                $IdealNegatif = $IdealKriteria->max('nilai');
            }

            // Simpan nilai solusi ideal positif dan negatif
            foreach ($IdealKriteria as $value) {
                $idealPositif = pow($value->nilai - $IdealPositif, 2);
                $dataPositif = [
                    'nilai' => $idealPositif,
                    'kriteria_id' => $value->kriteria_id,
                ];
                $this->topsisServices->simpanIdealPositif($dataPositif);

                $idealNegatif = pow($value->nilai - $IdealNegatif, 2);
                $dataNegatif = [
                    'nilai' => $idealNegatif,
                    'kriteria_id' => $value->kriteria_id,
                ];
                $this->topsisServices->simpanIdealNegatif($dataNegatif);
            }
        }
    }


    public function hitungSolusiIdeal()
    {
        $jarakIdealPositif = $this->topsisServices->getSolusiIdealPositif();
        $jarakIdealNegatif = $this->topsisServices->getSolusiIdealNegatif();

        foreach ($jarakIdealPositif as $item) {
            $jarakIdealPositifSi = $jarakIdealPositif->where('alternatif_id', $item->alternatif_id);
            $nilaiPositifSi = 0;

            foreach ($jarakIdealPositifSi as $value) {
                $nilaiPositifSi += $value->nilai;
            }
            $data = [
                'nilai' => sqrt($nilaiPositifSi),
                'alternatif_id' => $item->alternatif_id,
            ];
            $this->topsisServices->simpanSolusiIdealPositif($data);
        }

        foreach ($jarakIdealNegatif as $item) {
            $jarakIdealNegatifSi = $jarakIdealNegatif->where('alternatif_id', $item->alternatif_id);
            $nilaiNegatifSi = 0;

            foreach ($jarakIdealNegatifSi as $value) {
                $nilaiNegatifSi += $value->nilai;
            }
            $data = [
                'nilai' => sqrt($nilaiNegatifSi),
                'alternatif_id' => $item->alternatif_id,
            ];
            $this->topsisServices->simpanSolusiIdealNegatif($data);
        }
    }

    public function hitungHasil()
    {
        $solusiIdealPositif = $this->topsisServices->getSolusiIdealPositif();
        $solusiIdealNegatif = $this->topsisServices->getSolusiIdealNegatif();

        $dataPositif = [];
        $dataNegatif = [];
        $hitung = [];

        foreach ($solusiIdealPositif as $item) {
            $dataPositif[] = [
                'alternatif_id' => $item->alternatif_id,
                'nilai' => $item->nilai,
            ];
        }

        foreach ($solusiIdealNegatif as $item) {
            $dataNegatif[] = [
                'alternatif_id' => $item->alternatif_id,
                'nilai' => $item->nilai,
            ];
        }

        foreach ($dataPositif as $item) {
            foreach ($dataNegatif as $value) {
                if ($value['alternatif_id'] == $item['alternatif_id']) {
                    $hitung = [
                        'alternatif_id' => $item['alternatif_id'],
                        'nilai' => $value['nilai'] / ($item['nilai'] + $value['nilai']),
                    ];
                }
            }
            $this->topsisServices->simpanHasilTopsis($hitung);
            $hitung = [];
        }
    }
    public function rekomendasi(Request $request)
    {
        // Ambil input kriteria dari user
        $facility = $request->input('facility');
        $harga = $request->input('harga');
        $lokasi = $request->input('lokasi');
        $menu = $request->input('menu');
        $jam = $request->input('jam');

        // Ambil data kriteria dari database
        $dataKriteria = [
            'facility' => $facility,
            'harga' => $harga,
            'lokasi' => $lokasi,
            'menu' => $menu,
            'jam' => $jam,
        ];

        // Cari alternatif yang cocok berdasarkan kriteria dan subkriteria
        $rekomendasi = $this->filterAlternatifBerdasarkanKriteria($dataKriteria);

        // Tampilkan hasil rekomendasi
        return view('user.hitung.rekomendasi', ['rekomendasi' => $rekomendasi]);
    }

    private function filterAlternatifBerdasarkanKriteria($dataKriteria)
{
    $alternatif = Alternatif::with('objek')->get(); // Mengambil semua alternatif dengan relasi objek

    // Filter alternatif berdasarkan kriteria
    $filtered = $alternatif->filter(function($item) use ($dataKriteria) {
        foreach ($dataKriteria as $kriteria => $subKriteria) {
            // Mendapatkan penilaian untuk alternatif ini berdasarkan kriteria yang diberikan
            $penilaian = $item->penilaian()->where('kriteria_id', function($query) use ($kriteria) {
                $query->select('id')->from('kriteria')->where('kode', $kriteria);
            })->first();

            // Periksa apakah penilaian ada dan cocok dengan sub kriteria yang dipilih oleh pengguna
            if (!$penilaian || $penilaian->sub_kriteria->kode !== $subKriteria) {
                return false; // Jika salah satu kriteria tidak cocok, keluarkan dari hasil
            }
        }
        return true; // Semua kriteria cocok, masukkan ke hasil
    });

    return $filtered;
}




// Metode untuk memeriksa apakah alternatif cocok dengan subkriteria tertentu
public function isMatchingCriteria($alternatif, $kriteria, $subKriteria)
{
    // Asumsikan setiap alternatif memiliki relasi dengan subkriteria-nya
    return $alternatif->subKriterias->contains(function($sub) use ($kriteria, $subKriteria) {
        return $sub->kriteria->nama == $kriteria && $sub->nama == $subKriteria;
    });
}

}
