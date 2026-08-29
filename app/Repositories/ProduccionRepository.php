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
        $estado = $this->model->where("pedido", $id_pedido)
                             ->get();
        if ($estado->empty()) 
        {
            return null;
        }
    }

    public function getByProductoId(int $id_producto)
     {
        $estado = $this->model->where("producto", $id_producto)
                             ->get();
        if ($estado->empty()) 
        {
            return null;
        }
    }

    public function getByUsuarioId(int $id_usuario)
     {
        $estado = $this->model->where("usuario", $id_usuario)
                             ->get();
        if ($estado->empty()) 
        {
            return null;
        }
    }

    public function getByEstado(string $estado)
    {
        $estado = $this->model->where("estado", $estado)
                             ->get();
        if ($estado->empty()) 
        {
            return null;
        }
    }
}
