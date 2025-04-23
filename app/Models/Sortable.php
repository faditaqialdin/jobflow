<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Lottery;

/**
 * @property mixed $position
 */
abstract class Sortable extends Model
{
    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(static function (Builder $query) {
            return $query->orderBy('position');
        });

        static::creating(static function (Sortable $model) {
            $max = $model->querySortable()->max('position') ?? -1;
            $model->position = $max + 1;
        });

        static::deleting(static function (Sortable $model) {
            $model->displace();
        });
    }

    abstract protected function querySortable(): Relation;

    public function displace(): void
    {
        $this->move(999999);
    }

    public function move(int $position): void
    {
        Lottery::odds(2, outOf: 100)
            ->winner(fn() => $this->arrange())
            ->choose();

        DB::transaction(function () use ($position) {
            $current = $this->position;
            $after = $position;

            // If there was no position change, don't shift...
            if ($current === $after) {
                return;
            }

            // Move the target out of the position stack...
            $this->update(['position' => -1]);

            // Grab the shifted block and shift it up or down...
            $block = $this->querySortable()->whereBetween('position', [
                min($current, $after),
                max($current, $after),
            ]);

            $needToShiftBlockUpBecauseDraggingTargetDown = $current < $after;

            $needToShiftBlockUpBecauseDraggingTargetDown
                ? $block->decrement('position')
                : $block->increment('position');

            // Place target back in position stack...
            $this->update(['position' => $after]);
        });
    }

    public function arrange(): void
    {
        DB::transaction(function () {
            $position = 0;
            foreach ($this->querySortable()->get() as $model) {
                /** @var Sortable $model */
                $model->position = $position++;
                $model->save();
            }
        });
    }
}
