<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\RoleResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\PermissionResource;
use Filament\Navigation\MenuItem;
use Illuminate\Support\Facades\Auth;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        Filament::serving(function() {
            if (Auth::check()) {
                if (Auth::user()->is_admin === 1 && Auth::user()->hasAnyRole(['super-admin', 'admin', 'moderator'])) {
                    Filament::registerUserMenuItems([
                        MenuItem::make()
                            ->label('Home')
                            ->url('/')
                            ->icon('heroicon-o-home'),
                        MenuItem::make()
                            ->label('Manage Permissions')
                            ->url(PermissionResource::getUrl())
                            ->icon('heroicon-o-key'),
                        MenuItem::make()
                            ->label('Manage Roles')
                            ->url(RoleResource::getUrl())
                            ->icon('heroicon-o-cog'),
                        MenuItem::make()
                            ->label('Manage Users')
                            ->url(UserResource::getUrl())
                            ->icon('heroicon-o-users'),
                    ]);
                }
            }
        });
    }
}
