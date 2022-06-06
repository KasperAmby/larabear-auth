<?php

namespace GuardsmanPanda\LarabearAuth\Provider;

use Illuminate\Support\ServiceProvider;

class BearAuthServiceProvider extends ServiceProvider {
    public function boot(): void {
        if ($this->app->runningInConsole()) {
            $this->commands(commands: [
            ]);
            $this->loadMigrationsFrom(paths: [__DIR__ . '/../Migration']);
        }
    }
}
