<?php

namespace Modules\Admin\Repositories;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\Admin;

class AdminRepository extends BaseRepository
{
    public function getModel()
    {
        return Admin::class;
    }
}
