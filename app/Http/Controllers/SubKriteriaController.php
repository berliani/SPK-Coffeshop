<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubKriteriaStoreRequest;
use App\Http\Requests\SubKriteriaUpdateRequest;
use App\Http\Services\KriteriaService;
use App\Http\Services\SubKriteriaService;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    protected $subKriteriaService, $kriteriaService;

    public function __construct(SubKriteriaService $subKriteriaService, KriteriaService $kriteriaService)
    {
        $this->subKriteriaService = $subKriteriaService;
        $this->kriteriaService = $kriteriaService;
    }

    public function index()
    {
        $judul = "Sub Kriteria";

        $kriteria = $this->kriteriaService->getAll();

        $data = null;
        foreach ($kriteria as $item) {
            $data[] = [
                'kriteria_id' => $item->id,
                'kriteria' => $item->nama,
                'sub_kriteria' => $this->subKriteriaService->getWhereKriteria($item->id),
            ];
        }

        return view('admin.dashboard.sub_kriteria.index', [
            "judul" => $judul,
            "kriteria" => $kriteria,
            "data" => $data,
        ]);
    }


}
