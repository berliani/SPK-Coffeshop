<?php

namespace App\Http\Controllers;

use App\Http\Requests\KriteriaRequest;
use App\Http\Services\KriteriaService;
use App\Http\Services\PenilaianService;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    protected $kriteriaService, $penilaianService;

    public function __construct(KriteriaService $kriteriaService, PenilaianService $penilaianService)
    {
        $this->kriteriaService = $kriteriaService;
        $this->penilaianService = $penilaianService;
    }

    public function index()
    {
        $judul = "Kriteria";

        $data = $this->kriteriaService->getAll();
        $sumBobot = $this->kriteriaService->getSumBobot()->total_bobot;

        return view('admin.dashboard.kriteria.index', [
            "judul" => $judul,
            "data" => $data,
            "sumBobot" => $sumBobot,
        ]);
    }

}
