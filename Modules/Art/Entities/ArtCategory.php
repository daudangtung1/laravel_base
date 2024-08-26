<?php

namespace Modules\Art\Entities;

use Illuminate\Database\Eloquent\Model;

class ArtCategory extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'status',
    ];
}
