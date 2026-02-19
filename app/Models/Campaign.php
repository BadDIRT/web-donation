<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'article',
        'target_amount',
        'current_amount',
        'image',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // 🔥 progress percentage realtime
    public function getProgressPercentAttribute()
    {
        if ($this->target_amount == 0) return 0;

        return min(100, ($this->current_amount / $this->target_amount) * 100);
    }
}


