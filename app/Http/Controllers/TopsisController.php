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
        // Ambil matriks Y yang sudah dihitung
        $matriksY = $this->topsisServices->getMatriksY();

        // Loop setiap kriteria unik dari matriks Y
        foreach ($matriksY->unique('kriteria_id') as $item) {
            $kriteriaId = $item->kriteria_id;

            // Filter matriks Y berdasarkan kriteria saat ini
            $matriksYPerKriteria = $matriksY->where('kriteria_id', $kriteriaId);

            // Ambil data kriteria, termasuk 'tipe' untuk menentukan apakah cost atau benefit
            $kriteria = $this->kriteriaService->getDataById($kriteriaId);

            // Tentukan solusi ideal positif dan negatif berdasarkan jenis kriteria
            $idealPositif = null;
            $idealNegatif = null;

            if ($kriteria->tipe == 'benefit') {
                // Untuk kriteria benefit
                $idealPositif = $matriksYPerKriteria->max('nilai'); // Nilai terbesar
                $idealNegatif = $matriksYPerKriteria->min('nilai'); // Nilai terkecil
            } elseif ($kriteria->tipe == 'cost') {
                // Untuk kriteria cost
                $idealPositif = $matriksYPerKriteria->min('nilai'); // Nilai terkecil
                $idealNegatif = $matriksYPerKriteria->max('nilai'); // Nilai terbesar
            }

        }
    }


public function hitungSolusiIdeal() //D+ dan D-
{
    // Ambil matriks Y yang sudah dihitung
    $matriksY = $this->topsisServices->getMatriksY();

    // Ambil solusi ideal positif dan negatif dari matriks Y
    $solusiIdealPositif = $this->topsisServices->getIdealPositif();
    $solusiIdealNegatif = $this->topsisServices->getIdealNegatif();

    // Ambil semua alternatif ID unik dari matriks Y
    $alternatifIds = $matriksY->unique('alternatif_id')->pluck('alternatif_id');

    foreach ($alternatifIds as $alternatifId) {
        $nilaiPositifSi = 0;
        $nilaiNegatifSi = 0;

        // Iterasi setiap kriteria untuk setiap alternatif
        foreach ($matriksY->where('alternatif_id', $alternatifId) as $value) {
            $kriteriaId = $value->kriteria_id;

            // Cari nilai ideal positif dan negatif untuk kriteria yang sesuai
            $idealPositif = $solusiIdealPositif->firstWhere('kriteria_id', $kriteriaId);
            $idealNegatif = $solusiIdealNegatif->firstWhere('kriteria_id', $kriteriaId);

            if ($idealPositif && $idealNegatif) {
                // Rumus D+: sqrt(sum((IdealPositif - MatriksY)^2))
                $nilaiPositifSi += pow($idealPositif->nilai - $value->nilai, 2);

                // Rumus D-: sqrt(sum((MatriksY - IdealNegatif)^2))
                $nilaiNegatifSi += pow($value->nilai - $idealNegatif->nilai, 2);
            }
        }

        // Simpan hasil solusi ideal positif (D+)
        $dataPositif = [
            'nilai' => sqrt($nilaiPositifSi),
            'alternatif_id' => $alternatifId,
        ];

        // Simpan hasil solusi ideal negatif (D-)
        $dataNegatif = [
            'nilai' => sqrt($nilaiNegatifSi),
            'alternatif_id' => $alternatifId,
        ];

        // Pastikan alternatif_id tidak null sebelum menyimpan
        if ($alternatifId !== null) {
            $this->topsisServices->simpanSolusiIdealPositif($dataPositif);
            $this->topsisServices->simpanSolusiIdealNegatif($dataNegatif);
        } else {
            throw new \Exception("alternatif_id is null, tidak dapat menyimpan data solusi ideal.");
        }
    }
}


public function hitungHasil()
{
    $solusiIdealPositif = $this->topsisServices->getSolusiIdealPositif();
    $solusiIdealNegatif = $this->topsisServices->getSolusiIdealNegatif();

    $hasilTopsis = [];

    foreach ($solusiIdealNegatif as $itemNegatif) {
        // Cari solusi ideal positif yang sesuai dengan alternatif_id
        $itemPositif = $solusiIdealPositif->firstWhere('alternatif_id', $itemNegatif->alternatif_id);

        if ($itemPositif) {
            // Hitung nilai menggunakan rumus: d- / (d- + d+)
            $nilai = $itemNegatif->nilai / ($itemNegatif->nilai + $itemPositif->nilai);

            // Simpan hasil dengan alternatif_id
            $hasilTopsis[] = [
                'alternatif_id' => $itemNegatif->alternatif_id,
                'nilai' => $nilai,
            ];
        }
    }

    // Simpan hasil ke database
    foreach ($hasilTopsis as $hitung) {
        $this->topsisServices->simpanHasilTopsis($hitung);
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
