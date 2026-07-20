<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'name',
        'is_present',
        'guest_count',
        'wish',
    ];

    protected function casts(): array
    {
        return [
            'is_present' => 'boolean',
            'guest_count' => 'integer',
        ];
    }

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
