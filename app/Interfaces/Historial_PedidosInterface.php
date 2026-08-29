<?php

namespace App\Interfaces;



interface Historial_PedidosInterface extends BaseInterface

{
    public function getByPedidoId(int $id_pedido);
    public function getByUsuarioId(int $id_usuario);
    public function getByEstadoAnteriorId(int $estado_anterior);
    public function getByEstadoNuevoId(int $estado_nuevo);
}