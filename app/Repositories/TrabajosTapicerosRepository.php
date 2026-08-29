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

}