<?php

namespace App\Services;

use App\Interfaces\TrabajosTapicerosInterface;

class Trabajos_TapicerosService
{
    protected $trabajosTapicerosRepository;

    public function __construct(TrabajosTapicerosInterface $trabajosTapicerosRepository)
    {
        $this->trabajosTapicerosRepository = $trabajosTapicerosRepository;
    }

    public function list()
    {
        return $this->trabajosTapicerosRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->trabajosTapicerosRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->trabajosTapicerosRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->trabajosTapicerosRepository->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->trabajosTapicerosRepository->delete($id);
    }

    public function getByProduccionId(int $id_produccion)
     {
        return $this->trabajosTapicerosRepository->getByProduccionId($id_produccion);
     }
    
    
    public function getByUsuarioId(int $id_usuario)
    {
        return $this->trabajosTapicerosRepository->getByUsuarioId($id_usuario);
    }

    public function getByEstado(string $estado)
    {
        return $this->trabajosTapicerosRepository->getByEstado($estado);
    }

    public function getByFechaInicio(string $fecha_inicio)
    {
        return $this->trabajosTapicerosRepository->getByFechaInicio($fecha_inicio);
    }

    public function getByFechaFin(string $fecha_fin)
    {
        return $this->trabajosTapicerosRepository->getByFechaFin($fecha_fin);
    }
}