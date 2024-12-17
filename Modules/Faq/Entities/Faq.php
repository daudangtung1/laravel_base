<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'is_published',
    ];
}
