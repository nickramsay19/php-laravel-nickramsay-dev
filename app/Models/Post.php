<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Post extends Model {
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['created_at_date'];

    // commands

    public function trash() {
        $post->tags()->detach();
        return $post->delete();
    }

    public function publish() {
        $publishedAt = $this->published_at;

        $this->published_at = Carbon::now();
        $this->save();

        return $publishedAt;
    }

    public function unpublish() {
        $publishedAt = $this->published_at;

        $this->published_at = null;
        $this->save();

        return $publishedAt;
    }

    // utilities 

    public static function viewable() {
        return self::where(function ($query) {
            $query->whereNotNull('published_at')
                ->orWhere('author_id', Auth::user()?->id);
        });
    }

    // relations

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function allComments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function directComments(): HasMany {
        return $this->allComments()->whereNull('reference_id');
    }

    public function comments() {
        return $this->directComments()->with('referrers');
    }

    // attributes

    public function getCreatedAtDateAttribute(): string {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }

    public function getPublishedAtDateAttribute(): string {
        return Carbon::parse($this->published_at)->format('Y-m-d');
    }

    public function getIsPublishedAttribute(): bool {
        return isset($this->published_at);
    }

    // scopes

    public function scopeWhereSlug(Builder $query, ?string $slug): Builder {
        return $slug !== null ? $query->where('slug', $slug) : $query;
    }

    public function scopeWhereSlugIn(Builder $query, ?array $slugs): Builder {
        return $slugs !== null ? $query->whereIn('slug', $slugs) : $query;
    }

    public function scopeWhereTitle(Builder $query, ?string $title): Builder {
        return $title !== null ? $query->where('title', $title) : $query;
    }

    public function scopeWhereTitleIn(Builder $query, ?array $titles): Builder {
        return $titles !== null ? $query->whereIn('title', $titles) : $query;
    }

    public function scopeWhereAuthorName(Builder $query, ?string $authorName): Builder {
        return $authorName !== null ? $query->whereRelation('author', 'name', $authorName) : $query;
    }

    public function scopeWhereAuthorNameIn(Builder $query, ?array $authorNames): Builder {
        return $authorNames !== null
            ? $query->whereHas('author', function ($q) use ($authorNames) {
                $q->whereIn('name', $authorNames);
            })
            : $query;
    }

    public function scopeWherePublished(Builder $query, ?bool $published): Builder {
        return $query->unless($published == null, function ($q) {
            $q->when($published === true, function ($q) {
                $q->whereNotNull('published_at');
            }, function ($q) {
                $q->whereNull('published_at');
            });
        });
    }

    public function scopeWhereCreatedAfter(Builder $query, ?string $date): Builder {
        return $date !== null ? $query->where('created_at', '>=', $date) : $query;
    }

    public function scopeWhereCreatedBefore(Builder $query, ?string $date): Builder {
        return $date !== null ? $query->where('created_at', '<', $date) : $query;
    }

    public function scopeWherePublishedAfter(Builder $query, ?string $date): Builder {
        return $date !== null ? $query->where('published_at', '>=', $date) : $query;
    }

    public function scopeWherePublishedBefore(Builder $query, ?string $date): Builder {
        return $date !== null ? $query->where('published_at', '<', $date) : $query;
    }

    public function scopeWhereHasTags(Builder $query, ?array $tags): Builder {
        return !empty($tags)
            ? $query->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('name', $tags);
            })
            : $query;
    }

    public  function scopeWhereViewable(Builder $query): Builder {
        return $query->where(function ($query) {
            $query->whereNotNull('published_at')
                ->orWhere('author_id', Auth::user()?->id);
        });
    }

    public function scopeWhereIsListed(Builder $query): Builder {
        return $query->where('is_listed', 1);
    }
}