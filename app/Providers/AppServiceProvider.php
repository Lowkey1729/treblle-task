<?php

namespace App\Providers;

use App\Actions\Auth\API\APIAuthSessionAction;
use App\Actions\Auth\Web\WebAuthSessionAction;
use App\Actions\Auth\Web\WebRegisterUserAction;
use App\Http\Controllers\API\Auth\AuthAPISessionController;
use App\Http\Controllers\Web\Auth\AuthWebSessionController;
use App\Http\Controllers\Web\Auth\RegisterUserController;
use App\Services\Contracts\Auth\AuthInterface;
use App\Services\Contracts\Auth\RegisterInterFace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(AuthWebSessionController::class)
            ->needs(AuthInterface::class)
            ->give(fn () => new WebAuthSessionAction());

        $this->app->when(AuthAPISessionController::class)
            ->needs(AuthInterface::class)
            ->give(fn () => new APIAuthSessionAction());

        $this->app->when(RegisterUserController::class)
            ->needs(RegisterInterFace::class)
            ->give(fn () => new WebRegisterUserAction());

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventAccessingMissingAttributes();
        Model::preventSilentlyDiscardingAttributes();

        Model::preventLazyLoading(! app()->isProduction());
    }
}
