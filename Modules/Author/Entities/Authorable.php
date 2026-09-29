<?php

namespace Modules\Author\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Authorable — bảng nối polymorphic giữa author và entity bất kỳ
 * (post, post_category...) thông qua authorable_type / authorable_id.
 */
class Authorable extends Model
{
    protected $table = 'authorables';

    protected $fillable = [
        'author_id',
        'authorable_type',
        'authorable_id',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function authorable(): MorphTo
    {
        return $this->morphTo();
    }
}
