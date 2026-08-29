<?php

namespace App\Interfaces;



interface Trabajos_TapicerosInterface extends BaseInterface

{
    public function getByProduccionId(int $id_produccion);
    public function getByUsuarioId(int $id_usuario);
}