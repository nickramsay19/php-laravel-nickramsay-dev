<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
        if ($this->published_at == null) {
            $this->published_at = Carbon::now();
            $this->save();
        }
        
        return $this->published_at;
    }

    // utilities 

    public static function viewable() {
        return self::where(function ($query) {
            $query->whereNotNull('published_at')
                ->orWhere('author_id', Auth::user()?->id);
        });
    }

    // return the value it was before
    public function unpublish() {
        $publishedAt = $this->published_at;

        $this->published_at = null;
        $this->save();

        return $publishedAt;
    }

    // relations

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'post_tags');
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
}
