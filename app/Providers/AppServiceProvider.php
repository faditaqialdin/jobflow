<?php

namespace App\Providers;

use App\Gemini\GeminiJobDetectorService;
use App\Gemini\GeminiJobRecommenderService;
use App\Gmail\GmailClientFactory;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GeminiJobDetectorService::class, function () {
            return new GeminiJobDetectorService(config('gemini.prompt_opportunity_detected'));
        });

        $this->app->bind(GeminiJobRecommenderService::class, function () {
            return new GeminiJobRecommenderService(config('gemini.prompt_job_recommended'));
        });

        $this->app->bind(GmailClientFactory::class, function () {
            return new GmailClientFactory(
                config('services.google.client_id'),
                config('services.google.client_secret')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
