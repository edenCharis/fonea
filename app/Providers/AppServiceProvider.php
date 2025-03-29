<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 
     * 
     */
    protected $policies = [
        \App\Models\formationQual::class => \App\Policies\formationQualifiantePolicy::class,
        // Ajoutez d'autres modèles et policies si nécessaire
    ];
    
    public function register(): void
    {
        //

        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
