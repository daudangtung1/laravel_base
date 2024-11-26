<?php

namespace Modules\Author\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'full_name',
        'birth_day',
        'description',
        'address',
        'is_active',
        'is_block',
        'author_type_id',
        'slug',
        'phone',
    ];

    public function changeIsActive(): void
    {
        $this->is_active = 1;
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
