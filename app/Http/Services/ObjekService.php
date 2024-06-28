<?php

namespace App\Http\Services;

use App\Http\Repositories\ObjekRepository;

class ObjekService
{
    protected $objekRepository;

    public function __construct(ObjekRepository $objekRepository)
    {
        $this->objekRepository = $objekRepository;
    }

    public function getAll()
    {
        $data = $this->objekRepository->getAll();
        return $data;
    }

    public function simpanPostData($data)
    {
        return $this->objekRepository->simpan($data);
    }

    public function ubahGetData($request)
    {
        $data = $this->objekRepository->getDataById($request->id);
        return $data;
    }

    public function perbaruiPostData($data)
    {
       return isset($data['id']) ? $this->objekRepository->perbarui($data['id'], $data) : null;
    }

    public function hapusPostData($request)
    {
        $data = $this->objekRepository->hapus($request);
        return $data;
    }

    public function import($request)
    {
        $data = $this->objekRepository->import($request);
        return $data;
    }
}
