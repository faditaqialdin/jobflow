<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $access_token
 * @property string $refresh_token
 * @property Carbon $expires_at
 */
class GoogleToken extends Model
{
    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
