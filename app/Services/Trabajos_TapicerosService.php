<?php

namespace App\Services;

use App\Interfaces\Trabajos_TapicerosInterface;

class Trabajos_TapicerosService
{
    protected $trabajosTapicerosRepository;

    public function __construct(Trabajos_TapicerosInterface $trabajosTapicerosRepository)
    {
        $this->trabajosTapicerosRepository = $trabajosTapicerosRepository;
    }

    public function getByProduccionId(int $id_produccion)
     {
        $estado = $this->model->where("estado", $estado)
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