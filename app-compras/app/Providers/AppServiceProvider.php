<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Illuminate\Support\ServiceProvider;
use App\Http\Responses\RegisterResponse;

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

        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                ->modalHeading(__('common.panel_avalaible_titles.title'))
                ->visible(fn(): bool => auth()->user()?->hasAnyRole([
                    'admin',
                    'usuario',
                    'super_admin',
                ]))
                ->modalWidth('sm')
                ->panels(['admin', 'app'])
                ->labels([
                    'admin' => __('common.panel_avalaible_titles.admin'),
                    'app' => __('common.panel_avalaible_titles.app')
                ])
                ->icons([
                    'admin' => 'heroicon-o-square-2-stack',
                    'app' => 'heroicon-o-star',
                ], $asImage = false)
            ;
        });

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['es', 'fr', 'en', 'eu'])
                ->circular()
                ->flags([
                    'es' => asset('flags/es.svg'),
                    'fr' => asset('flags/fr.svg'),
                    'en' => asset('flags/us.svg'),

                    'eu' => asset('flags/es-pv.svg'),
                ]);
        });
    }
}
