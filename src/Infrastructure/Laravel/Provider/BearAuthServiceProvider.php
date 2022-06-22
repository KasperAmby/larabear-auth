<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Laravel\Provider;

use Illuminate\Support\ServiceProvider;

class BearAuthServiceProvider extends ServiceProvider {
    public function boot(): void {
        if ($this->app->runningInConsole()) {
            $this->commands(commands: [
            ]);
            $this->publishes(paths: [__DIR__ . '/../../config/config.php' => $this->app->configPath(path: 'bear-auth.php'),], groups: 'bear-auth');
            $this->loadMigrationsFrom(paths: [__DIR__ . '/../Migration']);
        }
    }
}
