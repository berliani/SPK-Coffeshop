<?php

namespace App\Http\Repositories;

use App\Models\SubKriteria;

class SubKriteriaRepository
{
    protected $subKriteria;

    public function __construct(SubKriteria $subKriteria)
    {
        $this->subKriteria = $subKriteria;
    }

    public function getAll()
    {
        $data = $this->subKriteria->all();
        return $data;
    }

    public function getWhereKriteria($kriteria_id)
    {
        $data = $this->subKriteria->where('kriteria_id', $kriteria_id)->orderBy('nilai', 'desc')->get();
        return $data;
    }

}
