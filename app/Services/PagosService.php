<?php

namespace App\Services;

use App\Interfaces\PagosInterface;

class PagosService
{
     public function __construct(private PagosInterface $pagosInterface)
    {}

     public function list()
    {
        return $this->pagosInterface->getAll();
    }

    public function store(array $data)
    {
        return $this->pagosInterface->create($data);
    }

    public function show(int $id)
    {
        return $this->pagosInterface->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->pagosInterface->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->pagosInterface->delete($id);
    }

}