<?php

namespace Modules\Author\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Author extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'full_name',
        'bio',
        'avatar',
        'email',
        'password',
        'website_url',
        'location',
        'is_active',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'published_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    /*---------------------------------------------------------------------------
    | Relationships
    |---------------------------------------------------------------------------*/

    public function authorTypes()
    {
        return $this->belongsToMany(AuthorType::class, 'author_type_author');
    }

    public function authorables()
    {
        return $this->hasMany(Authorable::class);
    }

    /*---------------------------------------------------------------------------
    | Scopes
    |---------------------------------------------------------------------------*/

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
