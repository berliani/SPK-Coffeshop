<?php

namespace App\Http\Services;

use App\Http\Repositories\KriteriaRepository;
use App\Http\Repositories\PenilaianRepository;

class KriteriaService
{
    protected $kriteriaRepository, $penilaianRepository;

    public function __construct(KriteriaRepository $kriteriaRepository, PenilaianRepository $penilaianRepository)
    {
        $this->kriteriaRepository = $kriteriaRepository;
        $this->penilaianRepository = $penilaianRepository;
    }

    public function getAll()
    {
        $data = $this->kriteriaRepository->getAll();
        return $data;
    }

    public function getDataById($id)
    {
        $data = $this->kriteriaRepository->getDataById($id);
        return $data;
    }

    public function getPaginate($perData)
    {
        $data = $this->kriteriaRepository->getPaginate($perData);
        return $data;
    }

    public function getSumBobot()
    {
        $data = $this->kriteriaRepository->getSumBobot();
        return $data;
    }
}
