<?php

namespace App\Http\Services;

use App\Http\Repositories\SubKriteriaRepository;

class SubKriteriaService
{
    protected $subKriteriaRepository;

    public function __construct(SubKriteriaRepository $subKriteriaRepository)
    {
        $this->subKriteriaRepository = $subKriteriaRepository;
    }

    public function getAll()
    {
        $data = $this->subKriteriaRepository->getAll();
        return $data;
    }

    public function getWhereKriteria($kriteria_id)
    {
        $data = $this->subKriteriaRepository->getWhereKriteria($kriteria_id);
        return $data;
    }

    }
