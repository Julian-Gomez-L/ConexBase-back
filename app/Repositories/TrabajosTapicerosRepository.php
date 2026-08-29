<?php

namespace App\Repositories;

use App\Interfaces\TrabajosTapicerosInterface;
use App\Models\TrtabajosTapiceros;

class TrabajosTapicerosRepository extends BaseRepository implements TrabajosTapicerosInterface
{
    public function __construct(TrabajosTapiceros $trabajosTapicerosModel)
    {
        parent::__construct($trabajosTapicerosModel);
    }

    public function getByProduccionId(int $id_produccion)
     {
        $estado = $this->model->where("produccion", $id_produccion)
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