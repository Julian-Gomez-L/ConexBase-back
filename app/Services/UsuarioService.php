<?php

namespace App\Services;

use App\Interfaces\UsuarioInterface;

class UsuarioService
{


    public function __construct(private UsuarioInterface $usuarioRepository)
    {}

    public function list()
    {
        return $this->usuarioRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->usuarioRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->usuarioRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->usuarioRepository->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->usuarioRepository->delete($id);
    }
}