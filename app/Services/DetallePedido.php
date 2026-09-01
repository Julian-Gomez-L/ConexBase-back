<?php

namespace App\Services;

use App\Interfaces\DetallesPedidoInterface;

class DestallePedidoService
{
     public function __construct(private DetallesPedidoInterface $detallesPedidoInterface)
    {}

     public function list()
    {
        return $this->detallesPedidoInterface->getAll();
    }

    public function store(array $data)
    {
        return $this->detallesPedidoInterface->create($data);
    }

    public function show(int $id)
    {
        return $this->detallesPedidoInterface->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->detallesPedidoInterface->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->detallesPedidoInterface->delete($id);
    }
}