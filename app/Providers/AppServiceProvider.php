<?php

namespace App\Providers;

use App\Actions\Auth\API\APIAuthSessionAction;
use App\Actions\Auth\API\APIRegisterUserAction;
use App\Actions\Auth\PasswordAction;
use App\Actions\Auth\Web\WebAuthSessionAction;
use App\Actions\Auth\Web\WebRegisterUserAction;
use App\Actions\User\UserAction;
use App\Http\Controllers\API\Auth\APIAuthSessionController;
use App\Http\Controllers\API\Auth\APIRegisterUserController;
use App\Http\Controllers\Web\Auth\WebAuthSessionController;
use App\Http\Controllers\Web\Auth\WebRegisterUserController;
use App\Services\Contracts\Auth\AuthInterface;
use App\Services\Contracts\Auth\PasswordInterface;
use App\Services\Contracts\Auth\RegisterInterFace;
use App\Services\Contracts\User\UserInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

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
