<?php

namespace App\Services;

use App\Interfaces\ProduccionInterface;

class ProduccionService
{
    protected $produccionRepository; //protected es para que solo se pueda acceder a esta propiedad desde la clase y sus subclases

    public function __construct
    (ProduccionInterface $produccionRepository)
    {
        $this->produccionRepository = $produccionRepository;
    }

    public function list()
    {
        return $this->produccionRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->produccionRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->produccionRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->produccionRepository->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->produccionRepository->delete($id);
    }
    
    public function getByPedidoId(int $id_pedido)
    {
        return $this->produccionRepository->getByPedidoId($id_pedido);
    }

    public function getByProductoId(int $id_producto)
    {
        return $this->produccionRepository->getByProductoId($id_producto);
    }

    public function getByUsuarioId(int $id_usuario)
    {
        return $this->produccionRepository->getByUsuarioId($id_usuario);
    }

}