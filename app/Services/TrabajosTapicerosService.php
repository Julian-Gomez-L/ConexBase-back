<?php

namespace App\Services;

use App\Interfaces\TrabajosTapicerosInterface;

class TrabajosTapicerosService
{
    public function __construct( private TrabajosTapicerosInterface $trabajosTapicerosRepository)
    {
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

}