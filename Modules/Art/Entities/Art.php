<?php

namespace Modules\Art\Entities;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'art_category_id',
        'size',
        'status',
        'path',
    ];
}
