<?php

namespace Modules\Author\Entities;

use Illuminate\Database\Eloquent\Model;

class AuthorType extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'color_hex',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    /*---------------------------------------------------------------------------
    | Relationships
    |---------------------------------------------------------------------------*/

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_type_author');
    }

    /*---------------------------------------------------------------------------
    | Scopes
    |---------------------------------------------------------------------------*/

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
