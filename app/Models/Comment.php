<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Comment extends Model {

    protected $guarded = [];

    protected $appends = ['created_at_date'];

    // relations

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class);
    }

    public function reference(): BelongsTo {
        return $this->belongsTo(self::class, 'reference_id');
    }

    public function allReferrers(): HasMany {
        return $this->hasMany(self::class, 'reference_id');
    }

    public function referrers(): HasMany {
        return $this->allReferrers()->with('referrers');
    }

    // attributes

    public function getCreatedAtDateAttribute(): string {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }
}
