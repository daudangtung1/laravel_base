<?php

namespace Modules\Author\Entities;

use Illuminate\Database\Eloquent\Model;

class AuthorType extends Model
{
    protected $table = 'author_types';

    protected $fillable = [
        'name',
        'color',
    ];
}
