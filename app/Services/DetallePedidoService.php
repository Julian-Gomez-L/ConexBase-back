<?php

namespace App\Services;

use App\Interfaces\DetallePedidoInterface;

class DetallePedidoService
{
    public function __construct(
        private DetallePedidoInterface $detallePedidoInterface
    ) {}

    public function list()
    {
        return $this->detallePedidoInterface->getAll();
    }

    public function store(array $data)
    {
        return $this->detallePedidoInterface->create($data);
    }

    public function show(int $id)
    {
        return $this->detallePedidoInterface->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->detallePedidoInterface->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->detallePedidoInterface->delete($id);
    }
}