<?php

namespace App\Http\Controllers;
use App\Models\HasilSolusiTopsis;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{

    public function goToKriteria2(Request $request)
{
    // Simpan kriteria pertama di sesi
    $request->session()->put('facility', $request->input('facility'));

    // Redirect ke halaman kedua
    return view('user.hitung.kriteria-2');
}

    public function showPilihKriteria()
    {
        return view('pilih_kriteria');
    }

    // Metode untuk memproses form kriteria
    public function submitKriteria(Request $request)
    {
        // Ambil data dari sesi dan input form
    $facility = $request->session()->get('facility');
    $harga = $request->input('harga');
    $lokasi = $request->input('lokasi');
    $menu = $request->input('menu');
    $jam = $request->input('jam');

    // Panggil metode untuk menghitung rekomendasi berdasarkan kriteria
    $rekomendasi = $this->hitungRekomendasi($facility, $harga, $lokasi, $menu, $jam);

    // Redirect ke halaman hasil rekomendasi dengan data yang sudah dihitung
    return view('user.hitung.hasil_rekomendasi', ['rekomendasi' => $rekomendasi]);
}

    // Metode untuk menghitung rekomendasi
    private function hitungRekomendasi($facility, $harga, $lokasi, $menu, $jam)
{
    // Contoh sederhana untuk mengambil semua data dari database
    $hasilSolusi = HasilSolusiTopsis::all();

    // Filter data berdasarkan kriteria yang diterima
    $filtered = $hasilSolusi->filter(function ($item) use ($facility, $harga, $lokasi, $menu, $jam) {
        return $item->facility_level == $facility &&
               $item->price_range == $harga &&
               $item->location == $lokasi &&
               $item->menu_variation == $menu &&
               $item->operating_hours == $jam;
    });

    // Sort data berdasarkan nilai TOPSIS
    $sorted = $filtered->sortByDesc('nilai_topsis');

    // Return hasil yang sudah difilter dan diurutkan
    return $sorted->take(10);
}

}
