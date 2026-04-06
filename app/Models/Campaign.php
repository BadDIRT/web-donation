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
        'slug',
        'description',
        'article',
        'target_amount',
        'current_amount',
        'current_amount_rd',
        'current_amount_rd_pengelola',
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

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    public function withdraws(): HasMany
    {
        return $this->hasMany(Withdraw::class);
    }

    public function updates(): HasMany
    {
        return $this->hasMany(CampaignUpdate::class)->orderBy('created_at', 'desc');
    }

    public function getAvailableBalanceAttribute()
    {
        $paid = $this->payouts()->sum('amount');

        return $this->current_amount - $paid;
    }

    // 🔥 progress percentage realtime
    public function getProgressPercentAttribute()
    {
        if ($this->target_amount == 0) return 0;

        return min(100, ($this->current_amount / $this->target_amount) * 100);
    }
}
