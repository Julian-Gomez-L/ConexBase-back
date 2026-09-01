<?php

namespace App\Services;

use App\Interfaces\ClientesInterface;

class ClientesService
{
    public function __construct(private ClientesInterface $clientesRepository)
    {}

    public function list()
    {
        return $this->clientesRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->clientesRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->clientesRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->clientesRepository->update($data, $id);
    }

    public function destroy(int $id)
    
    {return $this->clientesRepository->delete($id);}
    
       
}