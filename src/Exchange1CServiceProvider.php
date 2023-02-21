<?php
/**
 * This file is part of Sv1fT/laravel-exchange1c package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Sv1fT\LaravelExchange1C;

use Orchid\Platform\Dashboard;
use Sv1fT\Exchange1C\Config;
use Sv1fT\Exchange1C\Interfaces\CatalogInterface;
use Sv1fT\Exchange1C\Interfaces\EventDispatcherInterface;
use Sv1fT\Exchange1C\Interfaces\ModelBuilderInterface;
use Sv1fT\Exchange1C\ModelBuilder;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Sv1fT\Exchange1C\Services\CatalogService;
use Sv1fT\Exchange1C\Services\SaleService;

/**
 * Class Exchange1CServiceProvider.
 */
class Exchange1CServiceProvider extends ServiceProvider
{

    const CATALOG = 'catalog';
    private $class;
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // routes
        $this->loadRoutesFrom(__DIR__.'/../publish/routes.php');

        // config
        $this->publishes([__DIR__.'/../publish/config/' => config_path()], 'config');

        $this->publishes([__DIR__.'/../publish/database/migrations' => database_path('migrations')], 'migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Config::class, function ($app) {
            return new Config($app['config']['exchange1c']);
        });

        $this->app->singleton(EventDispatcherInterface::class, function ($app) {
            $laravelDispatcher = $app[Dispatcher::class];

            return new LaravelEventDispatcher($laravelDispatcher);
        });

        $this->app->singleton(ModelBuilderInterface::class, function ($app) {
            return $app[ModelBuilder::class];
        });

        if(request()->type == self::CATALOG){
            $this->class = CatalogService::class;
        }else{
            $this->class = SaleService::class;
        };
//
        $this->app->singleton(CatalogInterface::class, function($app){
            return $app[$this->class];
        });
    }
}
