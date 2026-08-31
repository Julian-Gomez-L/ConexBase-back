<?php

namespace App\Repositories;

use App\Interfaces\ProductosInterface;
use App\Models\Produccion;

class ProductosRepository extends BaseRepository implements ProductosInterface
{
    public function __construct(Productos $productosModel)
    {
        parent::__construct($productosModel);
    }

}
