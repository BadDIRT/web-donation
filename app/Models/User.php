<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_approved',
        'phone',
        'ktp_path',
        'profile_photo_path', // ✅ TAMBAHKAN INI
        'total_withdrawal',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    public function banks(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class, 'user_banks')
            ->withPivot('id', 'account_number', 'balance', 'is_primary')
            ->withTimestamps();
    }

    public function userBanks(): HasMany
    {
        return $this->hasMany(UserBank::class);
    }

    public function withdraws(): HasMany
    {
        return $this->hasMany(Withdraw::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =============================================
    // 🔥 ACCESSOR - FOTO PROFILE
    // =============================================
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return Storage::disk('public')->url($this->profile_photo_path);
        }

        // Default avatar berdasarkan inisial nama
        return null;
    }

    public function getInitialAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    public function getRoleColorAttribute()
    {
        return match ($this->role) {
            'admin' => 'from-red-400 to-red-600',
            'pengelola' => 'from-blue-400 to-blue-600',
            default => 'from-emerald-400 to-emerald-600',
        };
    }

    public function getRoleBadgeColorAttribute()
    {
        return match ($this->role) {
            'admin' => 'bg-red-100 text-red-700',
            'pengelola' => 'bg-blue-100 text-blue-700',
            default => 'bg-emerald-100 text-emerald-700',
        };
    }
}
