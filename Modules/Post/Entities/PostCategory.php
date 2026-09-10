<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'post_categories';

    protected $fillable = ['name', 'slug', 'description', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
