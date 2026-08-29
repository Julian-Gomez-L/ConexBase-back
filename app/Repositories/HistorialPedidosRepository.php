<?php

namespace App\Repositories;

use App\Interfaces\HistorialPedidosInterface;
use App\Models\HistorialPedidos;

class HistorialPedidosRepository extends BaseRepository implements HistorialPedidosInterface
{
    public function __construct(HistorialPedidos $historialPedidosModel)
    {
        parent::__construct($historialPedidosModel);
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

    public function getByUsuarioId(int $id_usuario)
    {
        $estado = $this->model->where("usuario", $id_usuario)
                             ->get();
        if ($estado->empty()) 
        {
            return null;
        }
    }

    public function getByEstadoAnterior(string $estado_anterior)
    {
        $estado = $this->model->where("estado_anterior", $estado_anterior)
                             ->get();
        if ($estado->empty()) 
        {
            return null;
        }
    }

    public function getByEstadoNuevo(string $estado_nuevo)
    {
        $estado = $this->model->where("estado_nuevo", $estado_nuevo)
                             ->get();
        if ($estado->empty()) 
        {
            return null;
        }
    }
}