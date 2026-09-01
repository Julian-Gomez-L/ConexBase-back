<?php

namespace App\Services;

use App\Interfaces\PedidosInterface;

class PedidosService
{
     public function __construct(private PedidosInterface $PedidosInterface)
    {}

     public function list()
    {
        return $this->PedidosInterface->getAll();
    }

    public function store(array $data)
    {
        return $this->PedidosInterface->create($data);
    }

    public function show(int $id)
    {
        return $this->PedidosInterface->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->PedidosInterface->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->PedidosInterface->delete($id);
    }
}