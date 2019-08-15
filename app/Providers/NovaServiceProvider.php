<?php

namespace App\Providers;

use App\Order;
use App\Client;
use App\Payment;
use App\Storage;
use App\Supplier;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use App\Observers\OrderObserver;
use App\Observers\ClientObserver;
use App\Observers\PaymentObserver;
use App\Observers\SupplierObserver;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function () {
            Order::observe(OrderObserver::class);
            Client::observe(ClientObserver::class);
            // Storage::observe(MaterialObserver::class);
            Payment::observe(PaymentObserver::class);
            // Supplier::observe(SupplierObserver::class);
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new \App\Nova\Metrics\NewClient,
            new \App\Nova\Metrics\TotalRevenue,
            new \App\Nova\Metrics\TotalCosts,
            // new \App\Nova\Metrics\TotalRemaining,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \Cendekia\SettingTool\SettingTool,
            new \Spatie\BackupTool\BackupTool(),
            // new \MadWeb\NovaTelescopeLink\TelescopeLink,
            // new \Tightenco\NovaReleases\AllReleases,
            // new \Davidpiesse\NovaMaintenanceMode\Tool(),
            // \ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs::make(),
            new \Infinety\Filemanager\FilemanagerTool(),
            new \Runline\ProfileTool\ProfileTool,
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
