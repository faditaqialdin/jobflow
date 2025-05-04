<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\GoogleTokenFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $access_token
 * @property string $refresh_token
 * @property Carbon $expires_at
 */
class GoogleToken extends Model
{
    /** @use HasFactory<GoogleTokenFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
