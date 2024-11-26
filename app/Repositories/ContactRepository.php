<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository extends BaseRepository
{
    public function getModel()
    {
        return Contact::class;
    }
}
