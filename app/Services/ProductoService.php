<?php

namespace App\Services;

use App\Interfaces\PrivatePedidosInterface;

class PrivatePedidosService
{
    public function __construct(PrivatePedidosInterface $historialPedidosRepository)

        
    }

    public function list()
    {
        return $this->historialPedidosRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->historialPedidosRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->historialPedidosRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->historialPedidosRepository->update($data, $id);
    }

    public function destroy(int $id)
    
    {
    
       
}