<?php

namespace App\Services;

use App\Interfaces\HistorialPedidosInterface;

class HistorialPedidosService
{
    public function __construct(HistorialPedidosInterface $historialPedidosRepository)
    {
        $this->historialPedidosRepository = $historialPedidosRepository;
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
        return $this->historialPedidosRepository->delete($id);
    }

    public function getByPedidoId(int $id_pedido)
     {
            return $this->historialPedidosRepository->getByPedidoId($id_pedido);
    }

    public function getByUsuarioId(int $id_usuario)
    {
        return $this->historialPedidosRepository->getByUsuarioId($id_usuario);
    }

    public function getByEstadoAnterior(string $estado_anterior)
    {
        return $this->historialPedidosRepository->getByEstadoAnterior($estado_anterior);
    }

    public function getByEstadoNuevo(string $estado_nuevo)
    {
        return $this->historialPedidosRepository->getByEstadoNuevo($estado_nuevo);
    }
}