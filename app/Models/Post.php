<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Post extends Model {
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $primaryKey = 'slug';
    protected $keyType = 'string';
    public $incrementing = false;

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

    // return value it was before
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
        //return $this->belongsToMany(Tag::class, 'post_tags');
        return $this->belongsToMany(
            Tag::class,
            'post_tags',      // pivot table
            'post_slug',      // foreign key on post_tags
            'tag_id',         // foreign key on post_tags
            'slug',           // local key on posts
            'id'              // local key on tags
        );
    }

    // attributes

    public function getCreatedAtDateAttribute(): string {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }
}
