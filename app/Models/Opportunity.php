<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\OpportunityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property User $user
 * @property int $user_id
 * @property string $name
 * @property string $company
 * @property string $companyLogo
 * @property string $url
 * @property string $description
 * @property Carbon $date
 * @property string $status
 */
class Opportunity extends Sortable
{
    /** @use HasFactory<OpportunityFactory> */
    use HasFactory, SoftDeletes;

    public const STATUSES = [
        [
            'name' => 'recommended',
            'icon' => 'bolt',
            'color' => 'amber',
        ],
        [
            'name' => 'applied',
            'icon' => 'check',
            'color' => 'indigo',
        ],
        [
            'name' => 'interview',
            'icon' => 'viewfinder-circle',
            'color' => 'lime',
        ],
        [
            'name' => 'offer',
            'icon' => 'briefcase',
            'color' => 'emerald',
        ],
        [
            'name' => 'reject',
            'icon' => 'x-mark',
            'color' => 'red',
        ],
    ];
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function querySortable(): Relation
    {
        return $this->user->opportunities()->where('status', $this->status);
    }
}
