<?php

namespace App\Repository\Queries;

use App\Models\Plans;
use App\Repository\Base\DBRepositoryImpl;
use App\Repository\Interfaces\PlansInterface;

class PlansRepo extends DBRepositoryImpl implements PlansInterface
{
    public function entity()
    {
        return Plans::class;
    }
}