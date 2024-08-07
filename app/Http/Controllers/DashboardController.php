<?php

namespace App\Http\Controllers;

use App\Http\Services\AlternatifService;
use App\Http\Services\KriteriaService;
use App\Http\Services\ObjekService;
use App\Http\Services\SubKriteriaService;
use App\Http\Services\TopsisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $kriteriaService, $subKriteriaService, $objekService, $alternatifService, $topsisServices;

    public function __construct(KriteriaService $kriteriaService, SubKriteriaService $subKriteriaService, ObjekService $objekService, AlternatifService $alternatifService, TopsisService $topsisServices)
    {
        $this->kriteriaService = $kriteriaService;
        $this->subKriteriaService = $subKriteriaService;
        $this->objekService = $objekService;
        $this->alternatifService = $alternatifService;
        $this->topsisServices = $topsisServices;
    }

    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
        $judul = "Dashboard";

        // Periksa peran pengguna
        if ($user->role == 'admin') {
            // Logika untuk dashboard admin
            $kriteria = $this->kriteriaService->getAll();
            $subKriteria = $this->subKriteriaService->getAll()->count();
            $objek = $this->objekService->getAll()->count();
            $alternatif = $this->alternatifService->getAll()->count();

            $hasilTopsis = $this->topsisServices->getHasilTopsis();
            $hasilAlternatif = "";
            $hasilNilai = "";
            foreach ($hasilTopsis as $item) {
                $hasilAlternatif .= $item->alternatif_id . ", ";
                $hasilNilai .= number_format($item->nilai, 3) . ", ";
            }
            $hasilAlternatif = rtrim($hasilAlternatif, ", ");
            $hasilNilai = rtrim($hasilNilai, ", ");

            $kriteriaID = "";
            $kriteriaBobot = "";
            foreach ($kriteria as $item) {
                $kriteriaID .= $item->id . ", ";
                $kriteriaBobot .= number_format($item->bobot, 3) . ", ";
            }
            $kriteriaID = rtrim($kriteriaID, ", ");
            $kriteriaBobot = rtrim($kriteriaBobot, ", ");

            return view('admin.dashboard.index', [
                "judul" => $judul,
                "jml_kriteria" => $kriteria->count(),
                "subKriteria" => $subKriteria,
                "objek" => $objek,
                "alternatif" => $alternatif,
                "hasilAlternatif" => $hasilAlternatif,
                "hasilNilai" => $hasilNilai,
                "kriteriaID" => $kriteriaID,
                "kriteriaBobot" => $kriteriaBobot,
                "kriteria" => $kriteria,
            ]);
        } elseif ($user->role == 'user') {
            // Logika untuk dashboard user
            $dataUserSpecific = $this->getUserSpecificData($user->id); // Misalnya, data yang hanya relevan untuk user

            return view('user.dashboard', [
                "judul" => $judul,
                "user_data" => $dataUserSpecific,
                // Tambahkan data lain yang relevan untuk user dashboard
            ]);
        } else {
            // Pengguna dengan peran tidak dikenal atau tidak memiliki hak akses yang sesuai
            return redirect('home')->with('error', 'Peran pengguna tidak dikenal');
        }
    }

    // Metode tambahan untuk mendapatkan data spesifik user, jika diperlukan
    private function getUserSpecificData($userId)
    {
        // Logika untuk mengambil data spesifik user
        // Misalnya, mengambil data alternatif yang hanya dimiliki oleh user tersebut
        return []; // Ganti dengan logika yang relevan
    }
}
