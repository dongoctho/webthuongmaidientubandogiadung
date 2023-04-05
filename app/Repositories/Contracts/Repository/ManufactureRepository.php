<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Manufacture;
use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Repositories\BaseRepository;

class ManufactureRepository extends BaseRepository implements ManufactureRepositoryInterface
{
    public function getModel()
    {
        return Manufacture::class;
    }
}
