<?php

namespace App\Repositories;

use App\Interfaces\ProduccionInterface;
use App\Models\Produccion;

class ProduccionRepository extends BaseRepository implements ProduccionInterface
{
    public function __construct(Produccion $produccionModel)
    {
        parent::__construct($produccionModel);
    }

    public function getByPedidoId(int $id_pedido)
    {
        return $this->model->where("id_pedido", $id_pedido)->get();
    }

    public function getByProductoId(int $id_producto)
    {
        return $this->model->where("id_producto", $id_producto)->get();
    }

    public function getByUsuarioId(int $id_usuario)
    {
        return $this->model->where("id_usuario", $id_usuario)->get();
    }

    public function getByTrabajosTapicerosId(int $id_trabajos_tapiceros)
    {
        return $this->model->where("id_trabajos_tapiceros", $id_trabajos_tapiceros)->get();
    }
    
}
