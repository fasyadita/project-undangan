<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme_id',
        'slug',
        'groom_name',
        'groom_nickname',
        'groom_father',
        'groom_mother',
        'groom_photo',
        'bride_name',
        'bride_nickname',
        'bride_father',
        'bride_mother',
        'bride_photo',
        'event_date',
        'event_time',
        'event_location',
        'event_address',
        'event_map_url',
        'music_url',
        'gallery',
        'story',
        'gift_accounts',
        'status',
        'plan',
        'active_until',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'story' => 'array',
            'gift_accounts' => 'array',
            'active_until' => 'datetime',
            'event_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
