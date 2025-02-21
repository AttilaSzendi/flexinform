<?php

namespace App\Providers;

use App\Models\Client;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        $this->seedDatabaseWhenEmpty();
    }

    public function seedDatabaseWhenEmpty(): void
    {
        if (app()->environment('local', 'development') && Client::query()->count() === 0) {
            Artisan::call('db:seed');
        }
    }
}
