<?php

namespace Modules\Faq\Repositories;

use App\Repositories\BaseRepository;
use App\Utils\Constant;
use Modules\Faq\Entities\Faq;

class FaqRepository extends BaseRepository
{
    public function getModel()
    {
        return Faq::class;
    }

    public function getList($paginate = Constant::DEFAULT_PAGINATE)
    {
        return $this->model->where('is_published', Constant::YES)->paginate($paginate);
    }
}
