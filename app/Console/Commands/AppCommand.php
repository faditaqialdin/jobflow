<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

abstract class AppCommand extends Command
{
    public function handle(): int
    {
        Log::info("$this->signature started");

        $lock = Cache::lock($this->signature);
        if (!$lock->get()) {
            Log::info("$this->signature already running. Skipping.");
            return self::SUCCESS;
        }

        try {
            $this->command();
        } catch (Throwable $throwable) {
            Log::error("$this->signature error", [
                'message' => $throwable->getMessage(),
                'trace' => $throwable->getTraceAsString(),
            ]);
            return self::FAILURE;
        } finally {
            $lock->release();
        }
        Log::info("$this->signature finished");
        return self::SUCCESS;
    }

    abstract public function command(): void;
}
