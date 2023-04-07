<?php
namespace Past\Paytr;

use Illuminate\Support\ServiceProvider;

class PaytrServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $configPath = __DIR__ . '/../config/paytr.php';
        $this->publishes([$configPath => config_path('paytr.php')], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/paytr.php', 'paytr');
        $this->app->singleton(Paytr::class, function ($app) {
            $config = config('paytr');
            if (is_null($config)) {
                throw InvalidConfigException::configNotFound();
            }

            $client = new Client([
                'base_uri' => $config['options']['base_uri'],
                'timeout' => $config['options']['timeout'],
            ]);
            return new Paytr($client, $config['credentials'], $config['options']);
        });
    }
}