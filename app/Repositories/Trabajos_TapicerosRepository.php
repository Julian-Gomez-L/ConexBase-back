<?php

namespace App\Repositories;

use App\Interfaces\Trabajos_TapicerosInterface;
use App\Models\Trtabajos_Tapiceros;

class Trabajos_tapicerosRepository extends BaseRepository implements Trabajos_TapicerosInterface
{
    public function __construct(Trabajos_Tapiceros $trabajosTapicerosModel)
    {
        parent::__construct($trabajosTapicerosModel);
    }

    public function getByProduccionId(int $id_produccion)
    {
        return $this->model->where("id_produccion", $id_produccion)->get();
    }

    public function getByUsuarioId(int $id_usuario)
    {
        return $this->model->where("id_usuario", $id_usuario)->get();
    }

}