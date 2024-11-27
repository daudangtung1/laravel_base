<?php

namespace Modules\Admin\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'email',
        'password',
    ];
}
