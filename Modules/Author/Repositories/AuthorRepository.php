<?php

namespace Modules\Author\Repositories;

use App\Repositories\BaseRepository;
use Modules\Author\Entities\Author;
use App\Utils\Constant;

class AuthorRepository extends BaseRepository
{
    public function getModel()
    {
        return Author::class;
    }

    public function getListByAdmin($paginate = Constant::DEFAULT_PAGINATE)
    {
        return $this->model->with('user')->paginate($paginate);
    }
}
