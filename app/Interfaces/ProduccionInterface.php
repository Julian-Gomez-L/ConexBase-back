<?php

namespace App\Interfaces;

interface ProduccionInterface extends BaseInterface

{
    public function getByPedidoId(int $id_pedido);
    public function getByProductoId(int $id_producto);
    public function getByUsuarioId(int $id_usuario);
}