<?php

namespace App\Repositories;

use App\Interfaces\ClientesInterface;
use App\Models\Produccion;

class ClientesRepository extends BaseRepository implements ClientesInterface
{
    public function __construct(Clientes $clientesModel)
    {
        parent::__construct($clientesModel);
    }

}
