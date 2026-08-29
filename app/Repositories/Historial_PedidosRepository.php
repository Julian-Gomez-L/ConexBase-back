<?php

namespace App\Repositories;

use App\Interfaces\Historial_PedidosInterface;
use App\Models\Historial_Pedidos;

class Historial_PedidosRepository extends BaseRepository implements Historial_PedidosInterface
{
    public function __construct(Historial_Pedidos $historialPedidosModel)
    {
        parent::__construct($historialPedidosModel);
    }

    public function getByPedidoId(int $id_pedido)
    {
        return $this->model->where("id_pedido", $id_pedido)->get();
    }

    public function getByUsuarioId(int $id_usuario)
    {
        return $this->model->where("id_usuario", $id_usuario)->get();
    }

    public function getByEstadoAnteriorId(int $estado_anterior)
    {
        return $this->model->where("id_estado_anterior", $estado_anterior)->get();
    }

    public function getByEstadoNuevoId(int $estado_nuevo)
    {
        return $this->model->where("id_estado_nuevo", $estado_nuevo)->get();
    }
}