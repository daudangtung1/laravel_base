<?php

namespace Modules\Author\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Post\Entities\Post;

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

    /**
     * Posts written by this author (qua bảng nối polymorphic authorables).
     */
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(
            Post::class,
            'authorable',
            'authorables',
            'author_id',
            'authorable_id'
        )->withPivot(['is_primary', 'sort_order']);
    }

    /**
     * Route model binding dùng username (duy nhất) thay vì id.
     */
    public function getRouteKeyName(): string
    {
        return 'username';
    }

    /*---------------------------------------------------------------------------
    | Scopes
    |---------------------------------------------------------------------------*/

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Tác giả hiển thị công khai: đang active và đã tới thời điểm publish.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $query) {
                $query->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }
}
