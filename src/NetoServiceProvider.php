<?php

namespace Sfinktah\Neto;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Laravel\Neto\Console\NetoCommand;

class NetoServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/../config/neto.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => $this->app->configPath('neto.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('neto');
        }

        $this->mergeConfigFrom($source, 'neto');
    }
}
