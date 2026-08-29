<?php

namespace App\Services;

use App\Interfaces\Historial_PedidosInterface;

class Historial_PedidosService
{
    public function __construct(Historial_PedidosInterface $historialPedidosRepository)
    {
        $this->historialPedidosRepository = $historialPedidosRepository;
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