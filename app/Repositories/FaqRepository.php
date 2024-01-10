<?php

namespace App\Repositories;

use App\Models\Faq;

class FaqRepository extends BaseRepository
{
    public function getModel()
    {
        return Faq::class;
    }
}
