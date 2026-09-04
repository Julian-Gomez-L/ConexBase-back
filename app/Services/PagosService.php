<?php

namespace App\Services;

use App\Interfaces\PagosInterface;

class PagosService
{
     public function __construct(private PagosInterface $pagosRepository)
    {}

     public function list()
    {
        return $this->pagosRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->pagosRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->pagosRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->pagosRepository->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->pagosRepository->delete($id);
    }

}