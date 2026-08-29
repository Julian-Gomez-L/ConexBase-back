<?php

namespace App\Interfaces;



interface TrabajosTapicerosInterface extends BaseInterface

{
    public function getByProduccionId(int $id_produccion);
    public function getByUsuarioId(int $id_usuario);
}