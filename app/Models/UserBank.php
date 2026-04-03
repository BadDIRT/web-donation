<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserBank extends Model
{
    protected $fillable = [
        'user_id',
        'bank_id',
        'account_number',
        'is_primary',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function withdraws(): HasMany
    {
        return $this->hasMany(Withdraw::class, 'user_bank_id');
    }
}
