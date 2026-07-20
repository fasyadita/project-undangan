<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'folder_name',
        'preview_image',
        'is_premium',
    ];

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }
}
