<?php

namespace Modules\Art\Repositories;

use App\Repositories\BaseRepository;
use Modules\Art\Entities\Tag;

class TagRepository extends BaseRepository
{
    public function getModel()
    {
        return Tag::class;
    }
}
